<?php

namespace MyApp\Controllers;

use Phalcon\Mvc\Controller;
use MyApp\Models\Products;

class ProductController extends Controller
{

    public function IndexAction()
    {
        // defalut action
    }

    public function addAction()
    {
        $product = new Products();
        $name = $this->request->getPost('pname');
        $category = $this->request->getPost('category');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');

        if ($name == "") {
            echo "Name cannot be empty";
            die;
        }
        if ($category == "") {
            echo "category cannot be empty";
            die;
        }
        if ($price  == "") {
            echo "price  cannot be empty";
            die;
        }
        if ($quantity  == "") {
            echo "quantity  cannot be empty";
            die;
        }
        if (!$product->validateprice($price)) {
            echo "price is less than equal to 0";
            die;
        }
        if (!$product->validatequantity($quantity)) {
            echo "quantity is less than equal to 0";
            die;
        }

        if (!$product->validatecategory($category)) {
            echo "category should be electronics & jwellery";
            die;
        } else {

            $product->assign(
                [
                    'name' => $name,
                    'category' => $category,
                    'price' => $price,
                    'quantity' => $quantity,
                ]
            );
            $success = $product->save();
            $this->view->success = $success;
            if ($success) {
                echo "saved succesfully";
                die;
            } else {
                $this->view->message = "Not saved due to following reason: <br>";
            }
        }
    }
}
