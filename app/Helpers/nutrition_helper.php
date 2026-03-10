<?php

use App\Models\UserModel;
use App\Models\MealModel;

if (!function_exists('daily_calorie_goal')) {

    function daily_calorie_goal($userId)
    {
        $userModel = new UserModel();

        $user = $userModel->find($userId);

        return $user['daily_calorie_goal'] ?? 2000;
    }
}

if (!function_exists('today_calories')) {

    function today_calories($userId)
    {
        $db = \Config\Database::connect();

        $result = $db->table('meals')
            ->selectSum('foods.calories', 'total')
            ->join('foods', 'foods.id = meals.food_id')
            ->where('meals.user_id', $userId)
            ->where('meal_date', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return $result['total'] ?? 0;
    }
}

if (!function_exists('calories_remaining')) {

    function calories_remaining($userId)
    {
        $goal = daily_calorie_goal($userId);
        $consumed = today_calories($userId);

        return $goal - $consumed;
    }
}

if (!function_exists('calorie_percentage')) {

    function calorie_percentage($userId)
    {
        $goal = daily_calorie_goal($userId);
        $consumed = today_calories($userId);

        if ($goal == 0) {
            return 0;
        }

        return round(($consumed / $goal) * 100);
    }
}

if (!function_exists('format_number')) {

    function format_number($number)
    {
        return number_format($number, 0, ',', '.');
    }
}