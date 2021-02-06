<?php
/**
 * @file
 * Contains \Drupal\frams_pro\Plugin\Block\XaiBlock.
 */

namespace Drupal\frams_pro\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;



/**
 * Provides a 'ConsolidatedList' block.
 *
 * @Block(
 *   id = "consolidated_list",
 *   admin_label = @Translation("Consolidated List block"),
 *   category = @Translation("Custom block")
 * )
 */
class ConsolidatedList extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
  	$application_received = \Drupal::database()->select('node', 'n')->addField('n', 'nid')->condition('n.type', 'application')->execute()->fetchAll(\PDO::FETCH_ASSOC);
	$application_inprogress = \Drupal::database()->select('node', 'n')->addField('n', 'nid')->condition('n.type', 'application')->condition('field_family_category','Couple','=')->execute()->fetchAll(\PDO::FETCH_ASSOC);
	$application_completed = \Drupal::database()->select('node', 'n')->addField('n', 'nid')->condition('n.type', 'application')->condition('field_family_category','Couple','=')->execute()->fetchAll(\PDO::FETCH_ASSOC);


  	return [
  	  '#type' => 'markup',
      '#markup' =>'<div class="consolidated-wrapper"><div class="d-inline-block"><h3 class="text-success">' . count($application_received) . '</h3><p class="text-success">Received</p></div><div class="d-inline-block"><h3 class="text-success">' . count($application_inprogress) . '</h3><p class="text-success">Inprogress</p></div><div class="d-inline-block"><h3 class="text-success">' . count($application_completed) . '</h3><p class="text-success">Completed</p></div></div>',
  	];
  }
}