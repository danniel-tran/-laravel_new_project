<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SliderModel as SliderModel;

class HomeController extends Controller
{
    private $pathViewController = "news.pages.home.";
    private $controllerName = "home";
    private $params      = [];

    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $sliderModel = new SliderModel();
        $itemsSlider   = $sliderModel->listItem(null, ['task'   => 'news-list-items']);
        return view(
            $this->pathViewController . "index",
            [
                'params'    => $this->params,
                'itemsSlider'  => $itemsSlider,
            ]
        );
    }
}
