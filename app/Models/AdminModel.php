<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminModel extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table = '';
    protected $folderUpload  = '';
    protected $fieldSearchAccepted  = [];
    protected $crudNotAccepted  = [];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function uploadThumb($thumbObj){
        $thumbName      = Str::random(10) . "_" . "." . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'zvn_storage_image');
        return $thumbName;
    }

    public function deleteThumb($thumbName){
        Storage::disk('zvn_storage_image')->delete($this->folderUpload . "/" . $thumbName);
    }

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
