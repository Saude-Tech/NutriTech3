<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table = 'foods';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'serving_size',
        'serving_weight'
    ];
}