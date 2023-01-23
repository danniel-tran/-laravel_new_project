<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SliderModel as MainModel;

class Slider extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = "slider";
    public function __construct()
    {
        $this->model = new MainModel();
        View::share('controllerName', $this->controllerName);
    }
    public function index()
    {
        $items = $this->model->listItem(null, ['task' => "admin-list-items"]);
        return view($this->pathViewController . "index", ['items' => $items]);
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
