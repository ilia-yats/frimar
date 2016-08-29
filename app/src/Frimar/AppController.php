<?php

namespace Frimar;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AppController
{
    /**
     * @var ContainerInterface
     */
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function install(Request $request, Response $response, array $args)
    {
        die('Automatic installation cannot be performed, please install manually');
    }

    public function home(Request $request, Response $response, array $args)
    {
        $this->ci->get('view')->render(
            $response,
            'app/home.twig'
        );
    }
}