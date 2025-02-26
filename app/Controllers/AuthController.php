<?php

namespace App\Controllers;

use App\Models\User;
use Rakit\Validation\Validator;



class AuthController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function index()
    {
        return view('admin.login');
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validator = new Validator;
            $validation = $validator->validate([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ], [
                'email' => "required|email|max:100",
                'password' => "required|max:100",
            ]);
            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                redirect($_ENV['BASE_URL']);
            } else {
                $users = $this->userModel->findAll();
                foreach ($users as $user) {
                    if ($user['email'] == $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
                        if ($user['role'] == 'admin') {
                            $_SESSION['user'] = $user;
                            redirect($_ENV['BASE_URL'] . 'dashboard');
                            exit();
                        } else {
                            $_SESSION['errors']['role'] = 'You do not have access';
                            redirect($_ENV['BASE_URL']);
                            exit();
                        }
                    } else {
                        $_SESSION['errors']['verify'] = 'Incorect email or password';
                        redirect($_ENV['BASE_URL']);
                        // exit();
                    }
                }
            }
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();
        redirect($_ENV['BASE_URL']);
        exit();
    }
}
