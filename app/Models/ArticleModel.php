<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'article';
        $this->folderUpload        = 'article';
        $this->fieldSearchAccepted = ['name', 'content', 'type', 'category_id'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel', "category_id");
    }

    public function listItem($params, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items") {
            // $query = self::select('id', 'name', 'content', 'type', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status','publish_at');
            $query = self::with(['category' => function ($query) {
                $query->select('id', 'name');
            }]);
            if (isset($params['filter']['status']) && $params['filter']['status'] != 'all') {
                $query->where("status", "=", $params['filter']['status']);
            }

            if (isset($params['search']['value']) && $params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
            if (
                isset($params['filter']['filter_category_id']) &&
                $params['filter']['filter_category_id'] !== false &&
                $params['filter']['filter_category_id'] !== "default"
            ) {
                $query->where(function ($query) use ($params) {
                    $query->where("category_id", '=',  "{$params['filter']['filter_category_id']}");
                });
            }
            $result = $query->orderBy("id", "desc")
                ->paginate($params['pagination']['totalItemsInPage']);
        }
        if ($options['task'] == 'news-list-items') {
            $query = self::select('id', 'name', 'content', 'thumb', 'type')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get()->toArray();
        }
        if ($options['task'] == 'news-list-items-featured') {

            $query = $this::from( 'article as a' )
                ->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', 'featured')
                ->orderBy('a.id', 'desc')
                ->take(3);

            $result = $query->get()->toArray();
        }
        if ($options['task'] == 'news-list-items-latest') {

            $query = $this::from( 'article as a' )
                ->select('a.id', 'a.name', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('id', 'desc')
                ->take(4);;
            $result = $query->get()->toArray();
        }
        return $result;
    }

    public function countByStatus($params, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-count-items-group-by-status") {
            $query = self::select(DB::raw('count(id) as count, status'))
                ->groupBy('status');
            if (isset($params['search']['value']) && $params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
            $result = $query->get()
                ->toArray();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'change-type') {
            self::where('id', $params['id'])->update(['type' => $params['currentType']]);
        }

        if ($options['task'] == 'add-item') {
            $params['thumb'] = $this->uploadThumb($params['thumb']);
            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d h:i:s');
            $params['publish_at'] = date('Y-m-d ');
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
            if (!empty($params['thumb'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            } else {
                array_push($this->crudNotAccepted, "thumb");
            }
            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            // self::destroy($params['id']);
            $item   = $this->getItem($params, ['task' => 'get-thumb']); // 
            $this->deleteThumb($item["thumb"]);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'content', 'status', 'type', 'thumb')->where('id', $params['id'])->first();
        }
        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }
        return $result;
    }
}
