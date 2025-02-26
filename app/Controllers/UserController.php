<?php

namespace App\Controllers;

use App\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function list()
    {
        if (isset($_GET['keyWord'])) {
            $users = $this->userModel->search($_GET['keyWord'], $_GET['page'] ?? 1, $_GET['limit'] ?? 10);
        } else {
            $users = $this->userModel->paginate($_GET['page'] ?? 1, $_GET['limit'] ?? 10);
        }

        view('admin.users.list-user', compact('users'));
    }
    public function add()
    {
        view('admin.users.add-user');
    }
    public function store()
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate(
                [
                    'username' => $_POST['username'],
                    'avatar' => $_FILES['avatar'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ],
                [
                    'username' => 'required|max:100',
                    'avatar' => 'required|uploaded_file:0,2M,png,jpg,jpeg',
                    'password' => 'required|max:20',
                    'email' => 'required|max:100|email',
                ]
            );
            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                redirect($_ENV['BASE_URL'] . 'user/add');
            } else {
                $avatar = $this->uploadFile($_FILES['avatar']);
                $username = $_POST['username'];
                $role = $_POST['role'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $status = $_POST['status'] == 'on' ? 1 : 0;
                $this->userModel->insert(compact('username', 'email', 'password', 'avatar', 'role', 'status'));
                redirect($_ENV['BASE_URL'] . 'user');
            }
        } catch (\Throwable $th) {
            echo "ERROR: " . $th->getMessage();
        }
    }
    public function update($id)
    {
        $user = $this->userModel->find($id);
        view('admin.users.update-user', compact('user'));
    }
    public function postUpdate($id)
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate(
                [
                    'username' => $_POST['username'],
                    'avatar' => $_FILES['avatar'],
                    'email' => $_POST['email'],

                ],
                [
                    'username' => 'required|max:100',
                    'avatar' => 'uploaded_file:0,2M,png,jpg,jpeg',
                    'email' => 'required|max:100|email',
                ]
            );
            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();
                redirect($_ENV['BASE_URL'] . 'user/update/' . $id);
            } else {
                $user = $this->userModel->find($id);
                if ($_FILES['avatar']['tmp_name'] != '' && isset($_FILES['avatar'])) {
                    $avatar = $this->uploadFile($_FILES['avatar']);
                    unlink($user['avatar']);
                } else {
                    $avatar = $user['avatar'];
                }

                $username = $_POST['username'];
                $role = $_POST['role'];
                $email = $_POST['email'];
                $status = $_POST['status'] == 'on' ? 1 : 0;
                $this->userModel->update($id, compact('username', 'email', 'avatar', 'role', 'status'));
                redirect($_ENV['BASE_URL'] . 'user');
            }
        } catch (\Throwable $th) {
            echo "ERROR: " . $th->getMessage();
        }
    }
    public function show($id)
    {
        $user = $this->userModel->find($id);
        view('admin.users.show-user', compact('user'));
    }
    public function delete($id)
    {
        try {
            $user = $this->userModel->find($id);
            if (file_exists($user['avatar'])) {
                unlink($user['avatar']);
            }
            $this->userModel->delete($id);
            $_SESSION['messages']['delete'] = 'Xóa thành công';
            redirect($_ENV['BASE_URL'] . 'user');
        } catch (\Throwable $th) {
            echo 'ERROR: ' . $th->getMessage();
        }
    }
}
