<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ItemCategoryModel;

class ItemModel extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_item_record';

    protected $primaryKey = 'ItemID';

    protected $fillable = [
        'item_code', 
        'item_name',
        'item_category', 
        'item_quantity',
        'item_price', 
        'item_status',
        'created_by',
        'date_created',
        'modified_by', 
        'date_modified',
    ];

    public function category() {
        return $this->belongsTo(ItemCategoryModel::class, 'item_category', 'CategoryID');
    }

    public function getCategoryNameAttribute() {
        return $this->category ? $this->category->category : null;
    }

    protected $appends = ['category_name'];
}

