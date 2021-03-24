<?php
namespace App\Services\Slack;

use \Illuminate\Notifications\Notifiable;
use \App\Notifications\SlackNotification;

class SlackService
{
    use Notifiable;
    public function send($message = null)
    {
        $when = now()->addMinutes(5);
        $this->notify(new SlackNotification($message))->delay($when);
    }
    protected function routeNotificationForSlack()
    {
        return env('SLACK_URL');
    }
}
