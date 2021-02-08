<?php

/**
 * Contains \Drupal\frams_pro\Controller\updates.
 *
 */
namespace Drupal\frams_pro\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\ProfileForm;
use  \Drupal\user\Entity\User;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Session\AccountInterface;
use Drupal\profile\Plugin\Field\ProfileEntityFieldItemList;
use Drupal\Core\Entity\Display\EntityFormDisplayInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\profile\Entity\ProfileType;
use Drupal\field\FieldConfigInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use \Drupal\node\Entity\Node;

/**
 * Creates a class named Updates extends ControllerBase
 * Implements a function for creating a custom page
 */
class Updates extends ControllerBase {
  public function user_delete() {
    $role = 'panchayat';
    $list = \Drupal::entityTypeManager()
        ->getStorage('profile')
        ->loadByProperties([
        'type' => 'panchayat',
      ]);
    foreach ($list as $profile) {
      $profile->delete();
    }
    $ids = \Drupal::entityQuery('user')
      ->condition('status', 1)
      ->condition('roles', $role)
      ->execute();
    $users = User::loadMultiple($ids);
    foreach($users as $user) {
      $user->delete();
    }


     /*$entities = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'applicaton']);


  /*entity_delete_multiple('node', $result);*/

    $build = [
      '#markup' => $this->t('Delete All users with ' . $role . ' role'),
    ];
    return $build;
  }
   public function update_field_archives() {
    $node_nids =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_archives',TRUE,'=')->execute();
    $archives = Node::loadMultiple($node_nids);

    foreach ($archives as $archive) {
      $archive->field_habitation = 5;
      $archive->field_self_cultivation = 5;
      $archive->field_ror_issued = TRUE;
      $archive->save();
    }
     $build = [
      '#markup' => $this->t('update All archives '),
    ];
    return $build;
   }


}