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
			->count()
			->accessCheck(FALSE)
			->execute();
		$application_inprogress = \Drupal::entityQuery('node')
			->condition('type','application')
			->condition('field_ror_issued',FALSE,'=')
			->count()
			->accessCheck(FALSE)
			->execute();
		$issued_female = \Drupal::entityQuery('node')
			->condition('type','application')
			->condition('field_ror_issued',TRUE,'=')
			->condition('field_family_category','female','=')
			->count()
			->accessCheck(FALSE)
			->execute();
		$issued_Couple = \Drupal::entityQuery('node')
			->condition('type','application')
			->condition('field_ror_issued',TRUE,'=')
			->condition('field_family_category','couple','=')
			->count()
			->accessCheck(FALSE)
			->execute();
		$issued_male = \Drupal::entityQuery('node')
			->condition('type','application')
			->condition('field_ror_issued',TRUE,'=')
			->condition('field_family_category','male','=')
			->count()
			->accessCheck(FALSE)
			->execute();
  	return [
  	  '#type' => 'markup',
      '#markup' =>'<div class="consolidated container"><div class="row text-center"><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $application_received . ' data-speed="1500"></h4><p class="count-text ">Received</p></div></div><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $application_inprogress . ' data-speed="1500"></h4><p class="count-text ">Inprogress</p></div></div><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $application_issued . ' data-speed="1500"></h4><p class="count-text ">Issued</p></div></div><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $issued_Couple . ' data-speed="1500"></h4><p class="count-text ">Couple</p></div></div><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $issued_female . ' data-speed="1500"></h4><p class="count-text ">Female headed</p></div></div><div class="col"><div class="counter"><h4 class="timer count-title count-number" data-to=' . $issued_male . ' data-speed="1500"></h4><p class="count-text ">Male headed</p></div></div></div></div>',
  	];
  }
}