<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonMethod;

class MealComment extends Model
{
    use HasFactory;
    use CommonMethod;

    protected $fillable = [
        'comment',
        'image',
    ];

// リーレーション---
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function meal_task(){
        return $this->belongsTo('App\Models\MealTask');
    }

}
