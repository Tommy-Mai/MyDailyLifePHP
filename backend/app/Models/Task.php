<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonMethod;

class Task extends Model
{
    use HasFactory;
    use CommonMethod;

    protected $dates = ['date','time'];

// リーレーション---
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function task_tag(){
        return $this->belongsTo('App\Models\TaskTag');
    }

    public function task_comments()
    {
        return $this->hasMany('App\Models\TaskComment', 'task_id');
    }
}
