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
        $html .= '<div class="flex items-center gap-2">';
        $html .= '<span class="text-sm font-medium text-primary">'.$caloria.' kcal </span>';
        $html .= '<button onclick="openAddFoodModal(\''.$key.'\')" 
                    class="w-8 h-8 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
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
                $html .= '<button 
                            type="button" 
                            onclick="removerAlimento('.$refeicao['refeicao_usuario_id'].')" 
                            class="text-red-500 hover:text-red-700 font-bold">
                            &times;
                        </button>';
                $html .= '</div>';

                $html .= '</li>';
            }

            $html .= '</ul>';
        }

        $html .= '</div>';

        return $html;
    }
}