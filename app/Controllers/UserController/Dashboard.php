<?php

namespace App\Controllers\UserController;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return  view("dashboard");
    }

}