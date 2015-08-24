<?php
namespace Acme\controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use duncan3dc\Laravel\BladeInstance;
use Acme\Email\SendEmail;

class RegisterController extends BaseController
{

    public function getShowRegisterPage()
    {
        echo $this->blade->render("register");
    }

    public function postShowRegisterPage()
    {
        $errors = [];

        $validation_data = [
          'first_name' => 'min:3',
          'last_name' => 'min:3',
          'email' => 'email',
          'verify_email' => 'email',
          'password' => 'min:3',
          'email' => 'equalTo:verify_email',
          'password' => 'equalTo:verify_password',
        ];

        // validate data
        $validator = new Validator();

        $errors = $validator->isValid($validation_data);

        // if validation fails, go back to register
        // page and display error message

        if (sizeof($errors) > 0)
        {
            $_SESSION['msg'] = $errors;
            echo $this->blade->render('register');
            unset($_SESSION['msg']);
            exit();
        }

        // save this data into a database
        $user = new User();
        $user->first_name = $_REQUEST['first_name'];
        $user->last_name = $_REQUEST['last_name'];
        $user->email = $_REQUEST['email'];
        $user->password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $user->save();

        $message = $this->blade->render('emails.welcome-email');
        
        SendEmail::sendEmail($user->email, "Welcome to Acme", $message);

        header("Location: /success");
        exit();
    }

}
