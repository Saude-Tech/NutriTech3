<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'email',
        'password'
    ];

    public function allUsers()
    {
        return $this -> findAll();
    }

    public function findByEmail($email)
    {
        return $this -> where('email', $email)->first();
    }

    public function findById($id)
    {
        return $this -> where('id', $id)->first();
    }
}