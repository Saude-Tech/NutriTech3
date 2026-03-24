<?php

if (!function_exists('renderizar_secao_refeicao')) {

    function renderizar_secao_refeicao($key, $titulo, $refeicoes = [])
    {
        $caloria = 0;

        foreach ($refeicoes as $ref) {
            $caloria += $ref['calorias'] ?? 0;
        }
        $html = '<div class="bg-white rounded-xl shadow p-3">';
        $html .= '<div class="flex justify-between items-center">';
        $html .= '<h4 class="font-medium text-gray-700">'.$titulo.'</h4>';
        $html .= '<div class"flex items center gap-2">';
        $html .= '<span class="text-sm font-medium text-gray-600">'.$caloria.' kcal </span>';
        $html .= '<button onclick="openMealModal(\''.$key.'\')" 
                    class="text-sm bg-green-500 text-white px-2 py-1 rounded">
                    +
                  </button>';
        $html .= '</div>';
        $html .= '</div>';

        if (empty($refeicoes)) {

            $html .= '<p class="text-sm text-gray-400 mt-2">Nenhuma refeição registrada</p>';

        } else {

            $html .= '<ul class="mt-2 text-sm text-gray-600 space-y-1">';

            foreach ($refeicoes as $refeicao) {

                $nome = $refeicao['nome'] ?? 'Receita';
                $calorias = $refeicao['calorias'] ?? 0;

                $html .= '<li class="flex justify-between items-center">';
                $html .= '<span>'.$nome.'</span>';

                $html .= '<div class="flex items-center gap-2">';
                $html .= '<span class="text-gray-400">'.$calorias.' kcal</span>';
                $html .= '<form method="POST" action="'.base_url('receitas/remover').'" class="inline">';
                $html .= '<input type="hidden" name="id" value="'.($refeicao['refeicao_usuario_id']).'">';
                $html .= '<button 
                            type="submit"
                            class="text-red-500 hover:text-red-700 font-bold">
                            &times;
                        </button>';
                $html .= '</form>';
                $html .= '</div>';

                $html .= '</li>';
            }

            $html .= '</ul>';
        }

        $html .= '</div>';

        return $html;
    }
}