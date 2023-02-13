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
        $this->params = ['pagination' => ["totalItemsInPage" => 5]];
        View::share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItem($this->params, ['task' => "admin-list-items"]);
        $itemsStatusCount   = $this->model->countByStatus($this->params, ['task' => 'admin-count-items-group-by-status']);
        return view(
            $this->pathViewController . "index",
            [
                'params' => $this->params,
                'items' => $items,
                'itemsStatusCount' =>  $itemsStatusCount
            ]
        );
    }

    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Cập nhật trạng thái thành công!');
    }

    public function form(Request $request)
    {
        $items = null;
        if ($request->id != null) {
            $params['id'] = $request->id;
            $items = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController . "form", [
            'item'        => $items
        ]);
    }

    public function edit($id)
    {
        $title = "sliderController - edit";
        return view($this->pathViewController . "form", ['id' => $id, 'title' => $title]);
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'detete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xóa phần tử thành công!');
    }

    public function save()
    {
        echo "this is " . __FILE__;
    }
}
