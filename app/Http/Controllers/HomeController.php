<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

class HomeController extends Controller
{
    private $pathViewController = "news.pages.category.";
    private $controllerName = "home";
    private $params      = [];

    public function __construct()
    {
        View::share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $sliderModel = new SliderModel();
        $categoryModel = new CategoryModel();
        $articleModel  = new ArticleModel();
        $itemsSlider   = $sliderModel->listItem(null, ['task'   => 'news-list-items']);
        $itemsCategory = $categoryModel->listItem(null, ['task' => 'news-list-items-is-home']);
        $itemsFeatured = $articleModel->listItem(null, ['task'  => 'news-list-items-featured']);
        $itemsLatest   = $articleModel->listItem(null, ['task'  => 'news-list-items-latest']);
        return view(
            $this->pathViewController . "index",
            [
                'params'         => $this->params,
                'itemsSlider'    => $itemsSlider,
                'itemsCategory'  => $itemsCategory,
                'itemsFeatured'  => $itemsFeatured,
                'itemsLatest'    => $itemsLatest,
            ]
        );
    }
}
