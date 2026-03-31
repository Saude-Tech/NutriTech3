<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\RecipeModel;
use App\Models\UserModel;
use App\Models\WaterModel;
use App\Models\ReceitaIngredienteModel;
use App\Models\RefeicoesUserModel;

class Dashboard extends BaseController
{

    protected $receitaIngredientesModel;
    protected $recipeModel;
    protected $waterModel;
    protected $userId;
    protected $refeicoesUser;
    protected $alimentosModel;

    public function __construct()
    {
        $this->receitaIngredientesModel = new ReceitaIngredienteModel();
        $this->recipeModel = new RecipeModel();
        $this->userId = new UserModel();
        $this->waterModel = new WaterModel();
        $this->refeicoesUser = new RefeicoesUserModel();
        $this->alimentosModel = new FoodModel();

        helper('auth'); // se você tiver helpers de autenticação
        helper('nutrition');
        helper('macro');
        helper('meal');
    }

    public function index()
    {
        $water = $this->waterModel->today(session('id'));

        $dadosHoje = $this->refeicoesUser->getAllReceitasHoje(session('id'));

        $refeicoesAgrupadas = [
            'cafe' => [],
            'almoco' => [],
            'jantar' => [],
            'lanche' => [],
        ];

        foreach ($dadosHoje as $ref) {
            $tipo = $ref['tipo_refeicao']; // ex: 'cafe', 'almoco', 'jantar'
            $refeicoesAgrupadas[$tipo][] = $ref;
        }
        $data = [
            'water' => $water['quantidade_ml'] ?? 0,
            'todayData' => $refeicoesAgrupadas,
            'title' => '',
            'style' => 'style',
            'style2' => 'dashboard',
            'javascript' => 'dashboard',
            'alimentos' => $this->alimentosModel->allFoods()
        ];


        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/index', $data);
        echo view('includes/footer', $data);
    }

    public function updateWater()
    {
        $userId = session('id');
        $glasses = (int) $this->request->getPost('glasses');

        $today = date('Y-m-d');

        $exists = $this->waterModel
            ->where('usuario_id', $userId)
            ->where('data_registro', $today)
            ->first();

        if ($exists) {

            $this->waterModel->update($exists['id'], [
                'quantidade_ml' => $glasses
            ]);
        } else {

            $this->waterModel->insert([
                'usuario_id' => $userId,
                'quantidade_ml' => $glasses,
                'data_registro' => $today
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'glasses' => $glasses
        ]);
    }

    public function adicionarAlimento()
    {
        $alimento_id = $this->request->getPost('alimento_id');
        $tipo_refeicao = $this->request->getPost('tipo_refeicao');
        $usuario_id = session('id');

        // 2. Validação básica de segurança
        if (empty($alimento_id) || empty($usuario_id)) {
            return $this->response->setJSON([
                'success' => false,
                'error'   => 'Dados incompletos ou usuário não logado.'
            ]);
        }

        $alimento = $this->alimentosModel->where('id', $alimento_id)->first();

        if (!$alimento) {
            return $this->response->setJSON([
                'success' => false,
                'error'   => 'Alimento não encontrado.'
            ]);
        }

        $dadosParaSalvar = [
            'usuario_id'    => $usuario_id,
            'receita_id'   => null,
            'tipo_refeicao' => $tipo_refeicao,
            'data_refeicao' => date('Y-m-d'), // Salva a data de hoje
            'alimento_id'   => $alimento_id,
        ];

        try {
            // 5. Faz o insert no banco de dados usando o seu Model de refeições/consumo
            // Substitua 'refeicoesUser' pelo nome correto do Model que gerencia essa tabela
            $this->refeicoesUser->insert($dadosParaSalvar);

            // 6. Retorna sucesso para a tela
            return $this->response->setJSON([
                'success' => true,
                'message' => $alimento['nome'] . ' adicionado ao seu diário!'
            ]);
        } catch (\Exception $e) {
            // Se o banco de dados falhar (ex: erro de conexão ou coluna faltando)
            return $this->response->setJSON([
                'success' => false,
                'error'   => 'Erro ao salvar: ' . $e->getMessage()
            ]);
        }
    }
}
