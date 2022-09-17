<?php

namespace George\ConsoleApp\Controllers;

use George\ConsoleApp\Traits\Validation;

class Controller
{

    public static $response;

    use Validation;
    public function __construct()
    {
        # code...
    }

    public function success($data)
    {
        self::$response=$data;
        return true;
    }

    public function fail($data)
    {
        self::$response=$data;
        return false;
    }
}