<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Http\Controllers\Controller;

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
        $categoryModel = new CategoryModel();
        $articleModel  = new ArticleModel();
        $itemsSlider   = $sliderModel->listItem(null, ['task'   => 'news-list-items']);
        $itemsCategory = $categoryModel->listItem(null, ['task' => 'news-list-items-is-home']);
        $itemsFeatured = $articleModel->listItem(null, ['task'  => 'news-list-items-featured']);
        $itemsLatest   = $articleModel->listItem(null, ['task'  => 'news-list-items-latest']);
        foreach ($itemsCategory as $key => $category)
            $itemsCategory[$key]['articles'] = $articleModel->listItem(['category_id' => $category['id']], ['task' => 'news-list-items-in-category']);
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
