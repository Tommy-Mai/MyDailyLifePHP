<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function meal_tasks()
    {
        return $this->hasMany('App\MealTask');
    }

    public function meal_comments()
    {
        return $this->hasMany('\App\MealComment');
    }

    public function task_tags()
    {
        return $this->hasMany('App\TaskTag');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function task_comments()
    {
        return $this->hasMany('\App\TaskComment');
    }

    public function memos()
    {
        return $this->hasMany('\App\Memo');
    }

    public function histories()
    {
        return $this->hasMany('\App\History');
    }
}
