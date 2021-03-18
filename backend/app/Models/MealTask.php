<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTask extends Model
{
    use HasFactory;
    public function meal_comments()
    {
        return $this->hasMany('\App\MealComment', 'task_id');
    }
}
