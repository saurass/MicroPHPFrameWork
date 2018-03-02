<?php

/**
 * Created by PhpStorm.
 * User: Saurass
 * Date: 01-03-2018
 * Time: 23:28
 */
include_once __DIR__.'/../Views/View.php';
class Controller
{
    public function index(){
        View::viewPage('main.home');
    }
}