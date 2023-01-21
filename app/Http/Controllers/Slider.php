<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Slider extends Controller
{
    private $pathViewController = "admin.slider.";
    private $controllerName = "slider";
    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }
    public function index()
    {
        return view($this->pathViewController . "index");
    }
    public function form()
    {
        $title = "sliderController - form";
        return view($this->pathViewController . "form", ['title' => $title]);
    }
    public function edit($id)
    {
        $title = "sliderController - edit";
        return view($this->pathViewController . "form", ['id' => $id, 'title' => $title]);
    }
    public function delete($id)
    {
        $title = "sliderController - delete";
        return view($this->pathViewController . "form", ['id' => $id, 'title' => $title]);
    }
}