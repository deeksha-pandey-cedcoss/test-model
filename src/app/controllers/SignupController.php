<?php

namespace MyApp\Controllers;

use Phalcon\Mvc\Controller;
use MyApp\Models\Users;

class SignupController extends Controller
{

    public function IndexAction()
    {
        // defalut action
    }

    public function registerAction()
    {
        $user = new Users();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($name == "") {
            echo "Name cannot be empty";
            die;
        }
        if ($email == "") {
            echo "email cannot be empty";
            die;
        }
        if ($password == "") {
            echo "password cannot be empty";
            die;
        }
        if (!$user->validateemail($email)) {
            echo "email is not accepeted";
            die;
        }
        if (!$user->strongpassword($password)) {
            echo "password is not accepeted";
            die;
        } else {

            $user->assign(
                $this->request->getPost(),
                [
                    'name',
                    'email',
                    'password'
                ]
            );
            $success = $user->save();
            $this->view->success = $success;
            if ($success) {
                $this->view->message = "Register succesfully";
            } else {
                $this->view->message = "Not Register due to following reason: <br>" .
                    implode("<br>", $user->getMessages());
            }
        }
    }
}
