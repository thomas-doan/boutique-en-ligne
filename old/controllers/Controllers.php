<?php


namespace Controllers;


abstract class Controllers
{

    protected $model;
    protected $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}
