<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        //helper('auth'); // se você tiver helpers de autenticação
    }

    public function index(): string {
        return view('auth/index');
    }

    public function login()
    {
        $rule = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rule)) {
            return view('auth/index', [
                'validation' => $this->validator
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['user_password'])) {
            session()->set([
                'user_id'   => $user['user_id'],
                'user_name' => $user['user_name'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Credenciais inválidas');
            return redirect()->to('/auth');
        }
    }
}