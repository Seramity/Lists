<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * Class Validator
 *
 * Validates form inputs based on set rules for each individual input.
 *
 * @package App\Validation
 */
class Validator
{

    /**
     * Errors set into an array.
     *
     * @var array
     */
    protected $errors;

    /**
     * Grabs inputs and runs them through the provided rules for each individual input.
     *
     * @param $request
     * @param array $rules
     *
     * @return $this
     */
    public function validate($request, array $rules)
    {
        foreach($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch(NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['validation_errors'] = $this->errors;

        return $this;
    }

    /**
     * Returns boolean of whether validation failed by counting the number of errors.
     *
     * @return bool
     */
    public function failed()
    {
        return !empty($this->errors);
    }
}