<?php

namespace MyApp\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

// user database
class Users extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;

    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new Uniqueness(
                [
                    'field'   => 'email',
                    'message' => 'The user email must be unique',
                ]
            )
        );
        if ($this->validationHasFailed() === true) {
            return false;
        }
    }
    public function validateemail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "$email is a valid email address";
            return 1;
        } else {
            echo "$email is not a valid email address";
            return 0;
        }
    }
    public function strongpassword($password): bool
    {
        $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if (preg_match($pattern, $password, $matches)) {
            echo "Nice password";
            return 1;
        } else {
            echo " password neeeded to be strong ..";
            return 0;
        }
    }
}
