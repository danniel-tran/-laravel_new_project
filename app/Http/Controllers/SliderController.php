<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = "slider";
    private $params      = [];
    public function __construct()
    {
        $this->model = new MainModel();
        $this->params = ['pagination' => ["totalItemsInPage" => 1]];
        View::share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItem($this->params, ['task' => "admin-list-items"]);
        $itemsStatusCount   = $this->model->countByStatus($this->params, ['task' => 'admin-count-items-group-by-status']);
        return view($this->pathViewController . "index",
            [
                'params' => $this->params,
                'items' => $items,
                'itemsStatusCount' =>  $itemsStatusCount
            ]
        );
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
