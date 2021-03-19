<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealComment extends Model
{
    use HasFactory;

// リーレーション---
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function meal_task(){
        return $this->belongsTo('App\MealTask');
    }
}
