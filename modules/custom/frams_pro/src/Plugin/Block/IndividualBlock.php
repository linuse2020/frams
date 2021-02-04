<?php
/**
 * @file
 * Contains \Drupal\frams_pro\Plugin\Block\XaiBlock.
 */

namespace Drupal\frams_pro\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\frams_pro\Controller\IndividualHabController;


/**
 * Provides a 'Individual' block.
 *
 * @Block(
 *   id = "app_block",
 *   admin_label = @Translation("Individual Rights block"),
 *   category = @Translation("Individual Rights block")
 * )
 */
class IndividualBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
     $controller_variable = new IndividualHabController;
     $rendering_in_block = $controller_variable->individual();
   /*  kint($rendering_in_block);*/
     return $rendering_in_block;
  }
}