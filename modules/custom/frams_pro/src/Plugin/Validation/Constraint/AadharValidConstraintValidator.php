<?php

namespace Drupal\frams_pro\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Aadhar number constraint.
 */
class AadharValidConstraintValidator extends ConstraintValidator {
  /**
   * {@inheritdoc}
   */
  public function validate($field, Constraint $constraint) {
    // This is a single-item field so we only need to
    // validate the first item
    $value = $field->value;
    // // Check the number format
    if (!_isAadharValid((int) $value)) {
      // The value is an incorrect format, so we set a 'violation'
      // aka error. The key we use for the constraint is the key
      // we set in the constraint, in this case $incorrectFormat.
      $this->context->addViolation($constraint->incorrectFormat, array('%aadhar' => $value));
    }
  }
}
