<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\RecipeModel;
use App\Models\UserModel;
use App\Models\WaterModel;
use App\Models\ReceitaIngredienteModel;
use App\Models\RefeicoesUserModel;
use App\Models\UnidadeModel;

class Dashboard extends BaseController
{

    protected $receitaIngredientesModel;
    protected $recipeModel;
    protected $waterModel;
    protected $userId;
    protected $refeicoesUser;
    protected $alimentosModel;
    protected $unidades;

    public function __construct()
    {
        $this->receitaIngredientesModel = new ReceitaIngredienteModel();
        $this->recipeModel = new RecipeModel();
        $this->userId = new UserModel();
        $this->waterModel = new WaterModel();
        $this->refeicoesUser = new RefeicoesUserModel();
        $this->alimentosModel = new FoodModel();
        $this->unidades = new UnidadeModel();

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
        $quantidade = $this->request->getPost('quantidade') ?? 0;
        $unidade_id = $this->request->getPost('unidade_id') ?? 1; // default gramas
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
            'quantidade'    => $quantidade,
            'unidade_id'    => $unidade_id,
        ];

        try {
            // 5. Faz o insert no banco de dados usando o seu Model de refeições/consumo
            // Substitua 'refeicoesUser' pelo nome correto do Model que gerencia essa tabela
            $this->refeicoesUser->insert($dadosParaSalvar);

            // 6. Retorna sucesso para a tela
            session()->setFlashdata('success', $alimento['nome'] . ' adicionado ao seu diário!');
            return redirect()->to('dashboard/alimentos?tipo_refeicao=' . $tipo_refeicao);
        } catch (\Exception $e) {
            // Se o banco de dados falhar (ex: erro de conexão ou coluna faltando)
            session()->setFlashdata('error', 'Erro ao salvar: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function alimentos()
    {
        $tipo_refeicao = $this->request->getGet('tipo_refeicao');
        $alimentos = $this->alimentosModel->allFoods();
        $unidades = $this->unidades->findAll();

        $data = [
            'alimentos' => $alimentos,
            'unidades' => $unidades,
            'tipo_refeicao' => $tipo_refeicao,
            'title' => 'Adicionar Alimento',
            'style' => 'style',
            'style2' => 'dashboard',
            'javascript' => 'dashboard'
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/alimentos', $data);
        echo view('includes/footer', $data);
    }

    public function removerAlimento()
    {
        $id = $this->request->getPost('id');
        $usuario_id = session('id');

        if (empty($id) || empty($usuario_id)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Dados inválidos']);
        }

        try {
            $this->refeicoesUser->where('id', $id)->where('usuario_id', $usuario_id)->delete();
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
