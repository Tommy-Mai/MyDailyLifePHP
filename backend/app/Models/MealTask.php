<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonMethod;

class MealTask extends Model
{
    use HasFactory;
    use CommonMethod;

    protected $dates = ['date','time'];

// リーレーション---
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function meal_tag(){
        return $this->belongsTo('App\Models\MealTag');
    }

    public function meal_comments()
    {
        return $this->hasMany('App\Models\MealComment', 'task_id');
    }
}
