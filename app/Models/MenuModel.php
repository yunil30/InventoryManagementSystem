<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model {
    protected $table = 'tbl_user_menu';

    protected $primaryKey = 'MenuID';

    public $timestamps = false;

    protected $fillable = [
        'menu_name',
        'menu_page',
        'parent_menu',
        'menu_type',
        'menu_index', 
        'menu_icon',
    ];
}
