<?php

namespace Frimar;

use Interop\Container\ContainerInterface;

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
        $install_stmt = $this->ci->get('db')->prepare("

        ");
    }
}