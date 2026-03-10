<?php

if (!function_exists('today_water')) {

    function today_water($userId)
    {
        $db = \Config\Database::connect();

        $result = $db->table('water_logs')
            ->select('glasses')
            ->where('user_id', $userId)
            ->where('log_date', date('Y-m-d'))
            ->get()
            ->getRowArray();

        return $result['glasses'] ?? 0;
    }
}


if (!function_exists('water_percentage')) {

    function water_percentage($glasses, $goal = 8)
    {
        return min(100, round(($glasses / $goal) * 100));
    }
}