<?php
namespace App\Services\Slack;

use Illuminate\Support\Facades\Facade;

class Slack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'slack';
    }
}
