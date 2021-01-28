<?php
/**
 * @file
 * Contains \Drupal\frams_pro\Plugin\Block\XaiBlock.
 */

namespace Drupal\frams_pro\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\frams_pro\Controller\IndividualHabController;


/**
 * Provides a 'Cultivation' block.
 *
 * @Block(
 *   id = "cul_block",
 *   admin_label = @Translation("Individual Cultivaton Rights block"),
 *   category = @Translation("Individual Cultivation Rights block")
 * )
 */
class IndividualCulBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $controller_variable = new IndividualHabController;
    $rendering_in_block = $controller_variable->individualCultivation();
    return $rendering_in_block;
  }
}