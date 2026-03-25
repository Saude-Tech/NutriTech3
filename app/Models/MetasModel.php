<?php

namespace App\Models;

use CodeIgniter\Model;

class MetasModel extends Model
{
    protected $table = 'metas_usuario';
    protected $allowedFields = [
        'usuario_id',
        'meta_peso',
        'meta_calorias',
        'nivel_atividade',
    ];

    public function findById($id) 
    {
        return $this->where('usuario_id', $id)
        ->first();
    }
}
