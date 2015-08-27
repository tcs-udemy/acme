<?php
namespace Acme\controllers;

use Acme\models\User;
use Acme\Validation\Validator;
use duncan3dc\Laravel\BladeInstance;
use Acme\email\SendEmail;
use Acme\models\UserPending;

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
          'email' => 'email|equalTo:verify_email|unique:User',
          'verify_email' => 'email',
          'password' => 'min:3|equalTo:verify_password',
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

        $token = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
        $user_pending = new UserPending;
        $user_pending->token = $token;
        $user_pending->user_id = $user->id;
        $user_pending->save();

        $message = $this->blade->render('emails.welcome-email',
            ['token' => $token]
        );

        SendEmail::sendEmail($user->email, "Welcome to Acme", $message);

        header("Location: /success");
        exit();
    }


    public function getVerifyAccount()
    {
        $user_id = 0;
        $token = $_GET['token'];

        // look up the token
        $user_pending = UserPending::where('token', '=', $token)->get();

        foreach($user_pending as $item){
            $user_id = $item->user_id;
        }

        if ($user_id > 0) {
            // make the user account active
            $user = User::find($user_id);
            $user->active = 1;
            $user->save();

            UserPending::where('token', '=', $token)->delete();

            header("Location: /account-activated");
            exit();
        } else {
            header("Location: /page-not-found");
            exit();
        }


    }

}
