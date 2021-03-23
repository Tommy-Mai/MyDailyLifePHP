<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $connection;

    const UPDATED_AT = null;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $connection = env('DB_LOG_CONNECTION', env('DB_CONNECTION', 'mysql'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'login_at',
        'logout_at',
        'used_time',
        'last_activity_at',
        'timeout',
        'timeout_time',
        'action_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
