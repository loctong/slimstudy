<?php
/**
 * Created by PhpStorm.
 * User: Tong Bao Loc
 * Date: 4/1/2019
 * Time: 4:26 PM
 */

namespace App\controllers;


class BaseController
{
    protected $container;

    /**
     * BaseController constructor.
     */
    public function __construct($container)
    {
        $this -> container = $container;
    }
}