<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $allowedFields = [
        'name',
        'description'
    ];

    public function getByID($id)
    {
        return $this->find($id);
    }

}