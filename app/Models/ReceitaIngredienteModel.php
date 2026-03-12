<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceitaIngredienteModel extends Model
{
    protected $table = 'receita_ingredientes';
    protected $allowedFields = [
        'receita_id',
        'alimento_id',
        'quantidade',
        'unidade_id',
    ];

    public function getIngredientesDaReceita($receitaId)
    {
        return $this->select('
                receita_ingredientes.quantidade,
                alimentos.nome AS alimento,
                unidades.nome AS unidade
            ')
            ->join('alimentos', 'alimentos.id = receita_ingredientes.alimento_id')
            ->join('unidades', 'unidades.id = receita_ingredientes.unidade_id')
            ->where('receita_id', $receitaId)
            ->findAll();
    }
    public function caloriasReceita($receitaId)
    {
        return $this->select('
        SUM((alimentos.calorias / 100) * receita_ingredientes.quantidade) as calorias
    ')
            ->join('alimentos', 'alimentos.id = receita_ingredientes.alimento_id')
            ->where('receita_id', $receitaId)
            ->first();
    }

    
}
