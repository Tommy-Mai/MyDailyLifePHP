<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTask extends Model
{
    use HasFactory;

    protected $dates = ['date','time'];

// リーレーション---
    public function meal_tag(){
        return $this->belongsTo('App\MealTag');
    }

    public function meal_comments()
    {
        return $this->hasMany('\App\MealComment', 'task_id');
    }

// メソッド---------
}
