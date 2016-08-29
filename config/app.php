<?php

return [
    'base_url' => 'http://frimar/web',
    'base_path' => __DIR__ . '/..',
    'mysql'    => [
        'dsn'       => 'mysql:dbname=frimar;host=localhost',
        'user_name' => 'root',
        'pass'      => '',
    ],
    'sqlite'   => [
        'dsn' => 'sqlite:' . __DIR__ . '/../database.db',
    ],

];