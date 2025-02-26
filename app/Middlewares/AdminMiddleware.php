<?php

namespace App\Middlewares;

class AdminMiddleware
{
    public static function isAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            $_SESSION['errors']['access'] = "You do not have access";
            redirect($_ENV['BASE_URL']);
            exit();
        }
    }
}
