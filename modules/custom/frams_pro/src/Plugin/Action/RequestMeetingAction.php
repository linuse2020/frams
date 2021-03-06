<?php

namespace Drupal\frams_pro\Plugin\Action;

use Drupal\node\Entity\Node;
use Drupal\views_bulk_operations\Action\ViewsBulkOperationsActionBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Content moderation publish node.
 *
 * @Action(
 *   id = "frams_pro_request_meeting_action",
 *   label = @Translation("Request for FRC Committee Meeting"),
 *   type = "node",
 *   confirm = TRUE
 * )
 */

class RequestMeetingAction extends ViewsBulkOperationsActionBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function execute(ContentEntityInterface $entity = NULL) {

    return $this->t('Click Send Button to send request to Panchayat Secretary for FRC Committee Meeting.');
  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    return FALSE;
  }
}