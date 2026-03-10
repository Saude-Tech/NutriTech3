<?php

if (!function_exists('today_macros')) {

    function today_macros($userId)
    {
        $db = \Config\Database::connect();

        $result = $db->table('meals')
            ->select('
                SUM(foods.protein * meals.quantity) as protein,
                SUM(foods.carbs * meals.quantity) as carbs,
                SUM(foods.fat * meals.quantity) as fat
            ')
            ->join('foods', 'foods.id = meals.food_id')
            ->where('meals.user_id', $userId)
            ->where('meal_date', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return [
            'protein' => round($result['protein'] ?? 0),
            'carbs' => round($result['carbs'] ?? 0),
            'fat' => round($result['fat'] ?? 0),
        ];
    }
}


if (!function_exists('macro_goals')) {

    function macro_goals($userId)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);

        $calories = $user['daily_calorie_goal'] ?? 2000;

        // divisão padrão
        $protein = ($calories * 0.30) / 4;
        $carbs = ($calories * 0.40) / 4;
        $fat = ($calories * 0.30) / 9;

        return [
            'protein' => round($protein),
            'carbs' => round($carbs),
            'fat' => round($fat)
        ];
    }
}


if (!function_exists('macro_percentage')) {

    function macro_percentage($value, $goal)
    {
        if ($goal == 0) {
            return 0;
        }

        $percentage = ($value / $goal) * 100;

        return min(round($percentage), 100);
    }
}