<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuModel;

class MenuMappingModel extends Model {
    protected $table = 'tbl_menu_mapping';

    protected $primaryKey = 'RecID';

    public $timestamps = false;

    protected $fillable = [
        'MenuID',
        'access_level',
    ];

    public function getMenuName() {
        return $this->belongsTo(MenuModel::class, 'MenuID', 'MenuID');
    }

    public function getMenuNameAttribute() {
        return $this->getMenuName ? $this->getMenuName->menu_name : null;
    }

    protected $appends = ['menu_name'];
}
