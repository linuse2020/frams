<?php

namespace Drupal\entity_reference_views_token\Plugin\EntityReferenceSelection;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\token\TokenInterface;
use Drupal\views\Plugin\EntityReferenceSelection\ViewsSelection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'selection' entity_reference.
 *
 * @EntityReferenceSelection(
 *   id = "entity_reference_views_token",
 *   label = @Translation("Views: Filter by an entity reference view with token"),
 *   group = "entity_reference_views_token",
 * )
 */
class ViewsTokenSelection extends ViewsSelection {

  /**
   * The token service.
   *
   * @var \Drupal\token\Token
   */
  protected $token;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_manager, ModuleHandlerInterface $module_handler, AccountInterface $current_user, TokenInterface $token) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $entity_manager, $module_handler, $current_user);
    $this->token = $token;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('module_handler'),
      $container->get('current_user'),
      $container->get('token')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $conf = $this->getConfiguration();
    $entity_type = $conf['target_type'];

    $form['tokens'] = array(
      '#theme' => 'token_tree_link',
      '#token_types' => [$entity_type],
      '#global_types' => TRUE,
      '#click_insert' => TRUE,
      '#show_restricted' => FALSE,
      '#recursion_limit' => 3,
      '#text' => t('Browse available tokens'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getReferenceableEntities($match = NULL, $match_operator = 'CONTAINS', $limit = 0) {
    $display_name = $this->getConfiguration()['view']['display_name'];
    $arguments = [];
    foreach ($this->getConfiguration()['view']['arguments'] as $argument) {
      $arguments[] = $this->doReplace($argument);
    }
    $result = [];
    if ($this->initializeView($match, $match_operator, $limit)) {
      // Get the results.
      $result = $this->view->executeDisplay($display_name, $arguments);
    }

    $return = [];
    if ($result) {
      foreach ($this->view->result as $row) {
        $entity = $row->_entity;
        $return[$entity->bundle()][$entity->id()] = $entity->label();
      }
    }
    return $return;
  }

  /**
   * {@inheritdoc}
   */
  public function validateReferenceableEntities(array $ids) {
    $display_name = $this->getConfiguration()['view']['display_name'];
    $arguments = [];
    foreach ($this->getConfiguration()['view']['arguments'] as $argument) {
      $arguments[] = $this->doReplace($argument);
    }
    $result = [];
    if ($this->initializeView(NULL, 'CONTAINS', 0, $ids)) {
      // Get the results.
      $entities = $this->view->executeDisplay($display_name, $arguments);
      $result = array_keys($entities);
    }
    return $result;
  }

  /**
   * Replaces an argument.
   *
   * @param string $argument
   *
   * @return string
   */
  protected function doReplace($argument) {
    $conf = $this->getConfiguration();
    $entity_type = $conf['target_type'];
    $entity = $conf['entity'];
    $data = [$entity_type => $entity];
    return $this->token->replace($argument, $data, ['clear' => TRUE]);
  }

}
