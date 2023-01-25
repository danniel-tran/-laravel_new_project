<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SliderModel extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = 'slider';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function listItem($params, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-list-items") {
            $query = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');
            if (isset($params['filter']['status']) && $params['filter']['status'] != 'all') {
                $query->where("status", "=", $params['filter']['status']);
            }
            $result = $query->orderBy("id", "desc")
                ->paginate(1);
        }
        return $result;
    }

    public function countByStatus($params, $options = null)
    {
        $result = null;
        if ($options['task'] == "admin-count-items-group-by-status") {
            $result = self::select(DB::raw('count(id) as count, status'))
                ->groupBy('status')
                ->get()
                ->toArray();
        }
        return $result;
    }
}
