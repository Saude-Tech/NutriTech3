<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_name',
        'user_email',
        'user_password'
    ];

    public function allUsers()
    {
        return $this -> findAll();
    }

    public function findByEmail($email)
    {
        return $this -> where('user_email', $email)->first();
    }
}