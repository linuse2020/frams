<?php

/**
 * Contains \Drupal\frams_pro\Controller\userprofile.
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

/**
 * Creates a class named UserProfile extends ControllerBase
 * Implements a function for creating a custom page
 */
class UserDelete extends ControllerBase {
  public function user_delete() {
    $role = 'promoter';
    $list = \Drupal::entityTypeManager()
        ->getStorage('profile')
        ->loadByProperties([
        'type' => 'promoter',
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
}