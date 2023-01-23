<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            $result = self::select('id', 'name')
                // ->where("id", ">", 4)
                ->get();
        }
        return $result;
    }
}
