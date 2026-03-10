<?php

namespace App\Models;

use CodeIgniter\Model;

class WaterModel extends Model
{
    protected $table = 'water_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'glasses',
        'log_date'
    ];

    public function findByUser($id)
    {
        return $this->where('user_id', $id)->first();
    }

    public function today($userId)
    {
        return $this->where('user_id', $userId)
                    ->first();
    }

    public function setTodayWater($userId, $glasses)
    {
        $today = $this->today($userId);

        if ($today) {

            return $this->update($today['id'], [
                'glasses' => $glasses
            ]);

        }

        return $this->insert([
            'user_id' => $userId,
            'glasses' => $glasses,
            'log_date' => date('Y-m-d')
        ]);
    }
}