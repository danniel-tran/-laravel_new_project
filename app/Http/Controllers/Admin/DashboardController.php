<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private $pathViewController = "admin.pages.dashboard.";
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