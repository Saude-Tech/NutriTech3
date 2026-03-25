<?php

namespace App\Controllers;

use App\Models\MetasModel;
use App\Models\UserModel;

class Profile extends BaseController
{

    protected $userId;
    protected $metasModel;

    public function __construct() {
        $this->userId = new UserModel();
        $this->metasModel = new MetasModel();
        helper('user');
    }

    public function index()
    {

        $usuario = $this->userId->findById(session('id'));
        $metas = $this->metasModel->findById($usuario['id']);

        $data = [
            'title' => '',
            'style' => 'style',
            'style2' => 'profile',
            'javascript' => 'profile',
            'user' => $usuario,
            'nivel_atividade' => $metas['nivel_atividade'] ?? null
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/profile.php');
        echo view('includes/footer', $data);
    }
}