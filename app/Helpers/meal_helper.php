<?php

if (!function_exists('renderizar_secao_refeicao')) {

function renderizar_secao_refeicao($key, $titulo, $refeicoes = [])
{
    $caloria = 0;
    foreach ($refeicoes as $ref) {
        $caloria += $ref['calorias'] ?? 0;
    }

    $html  = '<div class="bg-white rounded-2xl shadow-sm p-4 space-y-2">';

    // Cabeçalho
    $html .= '<div class="flex items-center justify-between">';
    $html .= '<h4 class="font-semibold text-gray-800">' . htmlspecialchars($titulo) . '</h4>';
    $html .= '<div class="flex items-center gap-2">';
    $html .= '<span class="text-sm font-semibold text-green-500">' . $caloria . ' kcal</span>';
    $html .= '<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>';
    $html .= '</div>';
    $html .= '</div>';

    // Itens
    if (!empty($refeicoes)) {
        $html .= '<div class="space-y-1">';
        foreach ($refeicoes as $refeicao) {
            $nome       = htmlspecialchars($refeicao['nome']               ?? 'Alimento');
            $quantidade = htmlspecialchars($refeicao['quantidade']         ?? '1');
            $unidade    = htmlspecialchars($refeicao['unidade']            ?? 'unidade');
            $calorias   = $refeicao['calorias']                            ?? 0;
            $rid        = (int) ($refeicao['refeicao_usuario_id']          ?? 0);
            $emoji      = $refeicao['emoji']                               ?? '🍽️';

            $html .= '<div class="flex items-center justify-between py-1.5">';

            $html .= '<div class="flex items-center gap-2">';
            $html .= '<span>' . $emoji . '</span>';
            $html .= '<div>';
            $html .= '<p class="text-sm font-medium text-gray-700">' . $nome . '</p>';
            $html .= '<p class="text-xs text-gray-400">' . $quantidade . ' ' . $unidade . '</p>';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="flex items-center gap-3">';
            $html .= '<span class="text-sm font-semibold text-green-500">' . $calorias . ' kcal</span>';
            $html .= '<button type="button" onclick="removerAlimento(' . $rid . ')"
                        class="text-gray-300 hover:text-red-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a1 1 0 011-1h4a1 1 0 011 1m-7 0H5m14 0h-2"/>
                        </svg>
                      </button>';
            $html .= '</div>';

            $html .= '</div>';
        }
        $html .= '</div>';
    }

    // Rodapé
    $html .= '<a href="' . base_url('dashboard/alimentos') . '"
                class="flex items-center justify-center gap-1 pt-1 text-sm text-gray-400 hover:text-green-500 transition-colors">';
    $html .= '+ Adicionar mais alimentos';
    $html .= '</a>';

    $html .= '</div>';

    return $html;
}
}