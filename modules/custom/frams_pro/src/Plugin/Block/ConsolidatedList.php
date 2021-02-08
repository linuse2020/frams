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
  	$application_received =  \Drupal::entityQuery('node')
			->condition('type','application')
			->count()
			->accessCheck(FALSE)
			->execute();
		$application_issued = \Drupal::entityQuery('node')
			->condition('type','application')
			->condition('field_ror_issued',TRUE,'=')
			->count()
			->accessCheck(FALSE)
			->execute();
		$application_inprogress = \Drupal::entityQuery('node')
			->condition('type','application')
			->count()
			->condition('field_ror_issued',FALSE,'=')
			->accessCheck(FALSE)
			->execute();
		$application_inprogress = \Drupal::entityQuery('node')
			->condition('type','application')
			->count()
			->condition('field_ror_issued',FALSE,'=')
			->condition('field_family_category','female','=')
			->accessCheck(FALSE)
			->execute();
		$application_inprogress = \Drupal::entityQuery('node')
			->condition('type','application')
			->count()
			->condition('field_ror_issued',FALSE,'=')
			->condition('field_family_category','couple','=')
			->accessCheck(FALSE)
			->execute();
		$application_inprogress = \Drupal::entityQuery('node')
			->condition('type','application')
			->count()
			->condition('field_ror_issued',FALSE,'=')
			->condition('field_family_category','male','=')
			->accessCheck(FALSE)
			->execute();


  	return [
  	  '#type' => 'markup',
      '#markup' =>'<div class="consolidated-wrapper"><div class="d-inline-block"><h3 class="text-success">' . $application_received. '</h3><p class="text-success">Received</p></div><div class="d-inline-block"><h3 class="text-success">' . $application_inprogress . '</h3><p class="text-success">Inprogress</p></div><div class="d-inline-block"><h3 class="text-success">' . $application_issued . '</h3><p class="text-success">Completed</p></div></div>',
  	];
  }
}