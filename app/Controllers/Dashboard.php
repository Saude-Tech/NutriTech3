<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        helper('auth'); // se você tiver helpers de autenticação
    }

    public function index()
    {

        $model = new UserModel();

        $data = [
            'title' => '',
            'style' => 'style',
            'style2' => 'dashboard',
            'javascript' => 'dashboard',
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/index');
        echo view('includes/footer', $data);
    }
}