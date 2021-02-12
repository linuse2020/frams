<?php
/**
 * @file
 * Contains \Drupal\frams_pro\Plugin\Block\XaiBlock.
 */

namespace Drupal\frams_pro\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\frams_pro\Controller\IndividualHabController;


/**
 * Provides a 'Individual Habitation' block.
 *
 * @Block(
 *   id = "app_block",
 *   admin_label = @Translation("Individual Habitation Rights block"),
 *   category = @Translation("Individual Habitation Rights block")
 * )
 */
class IndividualHabBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
     $controller_variable = new IndividualHabController;
     $rendering_in_block = $controller_variable->individualHabitation();
   /*  kint($rendering_in_block);*/
     return $rendering_in_block;
  }
}