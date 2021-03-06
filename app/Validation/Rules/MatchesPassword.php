<?php

namespace App\Validation\Rules;


use App\Models\User;
use Respect\Validation\Rules\AbstractRule;


class MatchesPassword extends AbstractRule
{
    /**
     * Provided password from form. (Change password form)
     *
     * @var string $password
     */
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Checks if input equals stored password.
     *
     * @param string $input
     *
     * @return bool
     */
    public function validate($input)
    {
        return password_verify($input, $this->password);
    }
}