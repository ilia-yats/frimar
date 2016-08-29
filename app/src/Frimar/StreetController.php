<?php

namespace Frimar;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class StreetController
{
    /**
     * @var ContainerInterface
     */
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function json_source(Request $request, Response $response, array $args)
    {
        if($request->isXhr()) {

            $district_id = $request->getParsedBodyParam('district_id', 0);

            $streets = [];
            $get_streets_stmt = $this->ci->get('db')->prepare("
                SELECT id, name FROM streets WHERE district_id = ?
            ");
            $get_streets_stmt->bindValue(1, $district_id, \PDO::PARAM_INT);
            if($get_streets_stmt->execute()){
                $streets = $get_streets_stmt->fetchAll();
            }

            return $response->withJson($streets);
        }
    }
}