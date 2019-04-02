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
//        $user = $this->container->db->table("users")->find(1);
//        var_dump($user->email);
        die();
        return $this->container->view->render($response, "home.twig");
    }

}