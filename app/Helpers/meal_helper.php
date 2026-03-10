<?php

if (!function_exists('renderMealSection')) {

    function renderMealSection($key, $title, $meals = [])
    {
        $html = '<div class="bg-white rounded-xl shadow p-3">';
        $html .= '<div class="flex justify-between items-center">';
        $html .= '<h4 class="font-medium text-gray-700">'.$title.'</h4>';
        $html .= '<button onclick="openMealModal(\''.$key.'\')" 
                    class="text-sm bg-green-500 text-white px-2 py-1 rounded">
                    +
                  </button>';
        $html .= '</div>';

        if (empty($meals)) {

            $html .= '<p class="text-sm text-gray-400 mt-2">Nenhum alimento registrado</p>';

        } else {

            $html .= '<ul class="mt-2 text-sm text-gray-600 space-y-1">';

            foreach ($meals as $meal) {

                $name = $meal['name'] ?? 'Alimento';
                $calories = $meal['calories'] ?? 0;

                $html .= '<li class="flex justify-between">';
                $html .= '<span>'.$name.'</span>';
                $html .= '<span class="text-gray-400">'.$calories.' kcal</span>';
                $html .= '</li>';

            }

            $html .= '</ul>';
        }

        $html .= '</div>';

        return $html;
    }

}