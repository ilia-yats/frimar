<?php
session_start();

require_once '../vendor/autoload.php';

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    require ("src/" . $class_name . ".php");
});

$container = new \Slim\Container;

$container['settings']['displayErrorDetails'] = true;

$container['config'] = function($c) {
    return new \Noodlehaus\Config('../config/app.php');
};

$container['view'] = function($c) {
    /**
     * @var \Interop\Container\ContainerInterface[] $c
     */
    $view = new \Slim\Views\Twig($c['config']->get('base_path') . '/app/views/');
    $view->addExtension(new Slim\Views\TwigExtension(
        $c['router'],
        $c['config']->get('base_url')
    ));
    return $view;
};

$container['db'] = function($c) {
    /**
     * @var \Interop\Container\ContainerInterface[] $c
     */
    $conn = new \PDO(
        $c['config']->get('mysql.dsn'),
        $c['config']->get('mysql.user_name'),
        $c['config']->get('mysql.pass')
    );
//    $conn = new \PDO($c['config']->get('sqlite.dsn'));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $conn;
};

$app = new \Slim\App($container);
require_once 'routes.php';