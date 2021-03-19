<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

// リーレーション---
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function task_tag(){
        return $this->belongsTo('App\TaskTag');
    }

    public function task_comments()
    {
        return $this->hasMany('\App\TaskComment', 'task_id');
    }
}
