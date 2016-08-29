<?php

$config =  [
    'base_url' => 'http://frimar/web',
    'base_path' => __DIR__ . '/..',
    'sqlite'   => [
        'dsn' => 'sqlite:' . __DIR__ . '/../database.db',
    ],
];

// Primitive checking if app is hosted on heroku.com
if(strpos($_SERVER['SERVER_NAME'], 'heroku') !== FALSE) {
    // Get connection params from environment variable, provided by heroku.com service
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $conn_params = [
        'dsn'  => 'mysql:dbname=' . substr($url["path"], 1) . ';host=' . $url["host"],
        'user' => $url["user"],
        'pass' => $url["pass"],
    ];
} else {
    $conn_params = [
        'dsn'  => 'mysql:dbname=frimar;host=localhost',
        'user' => 'root',
        'pass' => '',
    ];
}

$config['mysql'] = $conn_params;

return $config;