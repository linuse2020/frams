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
 *   id = "frams_Send_to_doc_verification",
 *   label = @Translation("Send to Document Verification"),
 *   type = "node",
 *   confirm = TRUE
 * )
 */

class SendToDocVerification extends ViewsBulkOperationsActionBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function execute(ContentEntityInterface $entity = NULL) {
    /*kint($state);
    exit();*/
    if (!$state = $entity->get('moderation_state')->getString()) {
      return $this->t(':title  - can\'t change state',
        [
          ':title' => $entity->getTitle(),
        ]
      );
    }

    switch ($state) {
      case 'draft':
        $entity->set('moderation_state', 'frc_document_verification');
        $entity->save();
        break;
    }

    return $this->t(':title state changed to :state',
      [
        ':title' => $entity->getTitle(),
        ':state' => $entity->get('moderation_state')->getString(),
      ]
    );
  }

  /**
   * {@inheritdoc}
   */
  public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
    return TRUE;
    if ($object instanceof Node) {
      $can_update = $object->access('update', $account, TRUE);
      $can_edit = $object->access('edit', $account, TRUE);

      return $can_edit->andIf($can_update)->isAllowed();
    }
    return FALSE;
  }
}