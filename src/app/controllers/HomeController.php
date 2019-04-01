<?php
/**
 * Created by PhpStorm.
 * User: Tong Bao Loc
 * Date: 4/1/2019
 * Time: 3:18 PM
 */

namespace App\controllers;

class HomeController extends BaseController
{

    protected $view;
    protected $logger;

    function index($request, $response)
    {
        $this->container->logger->addInfo("HomeController:index()");
        return $this->container->view->render($response, "home.twig");
    }

}