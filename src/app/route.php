<?php
/**
 * Created by PhpStorm.
 * User: Tong Bao Loc
 * Date: 4/1/2019
 * Time: 11:08 AM
 */

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function (Request $request, Response $response) {
    $this->logger->addInfo("Loading home page");
    $response = $this->view->render($response, "index.phtml");
    return $response;
});