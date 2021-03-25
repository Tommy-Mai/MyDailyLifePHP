<?php

return [
    // Webhook URL
    'url' => env('SLACK_URL'),

    // チャンネル設定
    'default' => 'contact',

    'channels' => [
        'contact' => [
            'username' => 'MyDailyLifePHP',
            'icon' => ':four_leaf_clover:',
            'channel' => 'contact',
        ],
    ],
];
