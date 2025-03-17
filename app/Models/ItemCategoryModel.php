<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategoryModel extends Model{
    protected $table = 'tbl_item_category';

    protected $primaryKey = 'CategoryID';

    public $timestamps = false;

    protected $fillable = [
        'category',
        'category_status',
        'created_by',
        'date_created',
        'modified_by', 
        'date_modified',
    ];
}
