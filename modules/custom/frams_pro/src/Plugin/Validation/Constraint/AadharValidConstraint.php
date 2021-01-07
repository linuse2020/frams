<?php

namespace Drupal\frams_pro\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted aadhar number is valid
 *
 * @Constraint(
 *   id = "AadharValid",
 *   label = @Translation("Aadhar Validation", context = "Validation"),
 * )
 */
class AadharValidConstraint extends Constraint {
  // The message that will be shown if the format is incorrect.
  public $incorrectFormat = 'Given Aadhar number <strong>%aadhar</strong> is not in valid format.';
}
