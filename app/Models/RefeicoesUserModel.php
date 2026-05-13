<?php

namespace App\Models;

use CodeIgniter\Model;

class RefeicoesUserModel extends Model
{

    protected $table = 'refeicoes_usuario';

    protected $allowedFields = [
        'usuario_id',
        'receita_id',
        'alimento_id',
        'tipo_refeicao',
        'data_refeicao',
        'unidade_nome',
        'quantidade'
    ];

    // Métodos para getReceitas
    public function getAllReceitas($user)
    {
        return $this->where('usuario_id', $user)->findAll();
    }
    public function getAllReceitasHoje($user)
    {
        return $this->db
            ->table('refeicoes_usuario ru')
            ->select('
            ru.id            as refeicao_usuario_id,
            ru.tipo_refeicao,
            ru.quantidade,
            ru.unidade_nome  as unidade,

            COALESCE(r.id,        a_avulso.id)   as id,
            COALESCE(r.nome,      a_avulso.nome) as nome,

            ROUND(
                COALESCE(
                    SUM(a_ing.calorias / 100 * ri.quantidade),
                    a_avulso.calorias * ru.quantidade
                )
            ) as calorias
        ')
            ->join('receitas r', 'r.id = ru.receita_id', 'left')
            ->join('receita_ingredientes ri', 'ri.receita_id = r.id', 'left')
            ->join('alimentos a_ing', 'a_ing.id = ri.alimento_id', 'left')
            ->join('alimentos a_avulso', 'a_avulso.id = ru.alimento_id', 'left')
            ->where('ru.usuario_id', $user)
            ->where('ru.data_refeicao', date('Y-m-d'))
            ->groupBy('ru.id')
            ->get()
            ->getResultArray();
    }

    public function getAllReceitasSemana($user)
    {
        return $this->where('usuario_id', $user)
            ->select("
                YEAR(data_refeicao) as ano,
                WEEK(data_refeicao, 1) as semana,
                SUM(valor) as total
            ")
            ->groupBy('YEAR(data_refeicao), WEEK(data_refeicao, 1)')
            ->orderBy('ano', 'ASC')
            ->orderBy('semana', 'ASC')
            ->findAll();
    }
}