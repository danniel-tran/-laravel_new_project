<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'category';
        $this->fieldSearchAccepted = ['id', 'name'];
        $this->crudNotAccepted     = ['_token'];
    }
    
    public function listItem($params, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items") {
            $query = self::select('id', 'name', 'created', 'created_by', 'modified', 'modified_by', 'status');
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
            $result = $query->orderBy("id", "desc")
                ->paginate($params['pagination']['totalItemsInPage']);
        }
        if($options['task'] == 'news-list-items') {
            $query = self::select('id', 'name', 'description', 'link', 'thumb')
                        ->where('status', '=', 'active' )
                        ->limit(5);

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
        if($options['task'] == 'add-item') {
            $params['created_by'] = "hailan";
            $params['created']    = date('Y-m-d h:i:s');
            self::insert($this->prepareParams($params));        
        }
        
        if($options['task'] == 'edit-item') {
            $params['modified_by']   = "hailan";
            $params['modified']      = date('Y-m-d');
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
        
    }

    public function getItem($params, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'status')->where('id', $params['id'])->first();
        }
        return $result;
    }

}
