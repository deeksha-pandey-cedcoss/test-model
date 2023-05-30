<?php

namespace MyApp\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;

// user database
class Products extends Model
{
    public $id;
    public $name;
    public $category;
    public $price;
    public $quantity;

    public function validation()
    {
        $validator = new Validation();

        // Type must be: droid, mechanical or virtual
        $validator->add(
            "category",
            new InclusionIn(
                [
                    'message' => 'category must be "electronics", "jwellery"',
                    'domain' => [
                        'electronics',
                        'jwellery',
                    ],
                ]
            )
        );

        // Robot name must be unique
        $validator->add(
            'name',
            new Uniqueness(
                [
                    'field'   => 'name',
                    'message' => 'The product name must be unique',
                ]
            )
        );

        // price cannot be less than zero
        if ($this->price < 0) {
            $this->appendMessage(
                new Message('The price cannot be less than zero')
            );
        }
        // quantity cannot be less than zero
        if ($this->quantity < 0) {
            $this->appendMessage(
                new Message('The quantity cannot be less than zero')
            );
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() === true) {
            return false;
        }
    }
    public function validateprice($price): bool
    {
        if ($price <= 0) {
            echo "'The price cannot be less than zero'";
            return false;
        } else {
            return true;
        }
    }
    public function validatequantity($quantity): bool
    {
        if ($quantity <= 0) {
            echo "'The qunatity cannot be less than zero'";
            return false;
        } else {
            return true;
        }
    }
    public function validatecategory($category): bool
    {
        if ($category == "electronics" || $category == "jwellery") {
            echo "'The category is cool'";
            return true;
        } else {
            echo "'The category is not matching electronics & jwellery'";
            return false;
        }
    }
}
