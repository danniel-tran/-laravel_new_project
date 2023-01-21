<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Dashboard extends Controller
{
    private $pathViewController = "admin.dashboard.";
    private $controllerName = "dashboard";
    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }
    public function index()
    {
        return view($this->pathViewController . "index");
    }
}