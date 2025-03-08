<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMappingModel extends Model {
    protected $table = 'tbl_menu_mapping';

    protected $primaryKey = 'RecID';

    public $timestamps = false;

    protected $fillable = [
        'MenuID',
        'access_level',
    ];
}
