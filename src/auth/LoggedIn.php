<?php
namespace Acme\Auth;

use Acme\models\User;

class LoggedIn
{
    public static function user()
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            return $user;
        } else {
            return false;
        }
    }
}
