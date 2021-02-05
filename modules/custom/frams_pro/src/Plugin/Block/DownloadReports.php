<?php
/**
 * @file
 * Contains \Drupal\frams_pro\Plugin\Block\XaiBlock.
 */

namespace Drupal\frams_pro\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\frams_pro\Controller\IndividualHabController;


/**
 * Provides a 'DownloadReport' block.
 *
 * @Block(
 *   id = "download_report",
 *   admin_label = @Translation("Download Report block"),
 *   category = @Translation("Individual Habitation Rights block")
 * )
 */
class DownloadReports extends BlockBase {
  /**
   * {@inheritdoc}
   */

	public function build()	{
		$current_path = \Drupal::request()->getRequestUri();
		$split = explode("/", $current_path);
		$filename = $split[count($split)-1];		/*kint($filename);
  	kint($split);
  	kint($current_path);*/


    return [
    	'#type' => 'markup',
      '#markup' => "<a class='btn btn-primary pl-5 pr-5 m-3' href='".$current_path."/download/pdf'>PDF</a><a class='btn btn-primary pl-5 pr-5 m-3' href='".$current_path."/download/csv'>Excel</a>",
    ];
	}
}