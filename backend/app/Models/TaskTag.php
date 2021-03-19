<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    use HasFactory;

// リーレーション---
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tasks()
    {
        return $this->hasMany('\App\Task', 'tag_id');
    }
}
