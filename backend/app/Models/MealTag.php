<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTag extends Model
{
    use HasFactory;
    public function meal_tasks()
    {
        return $this->hasMany('App\Models\MealTask', 'tag_id');
    }
}
