<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductCategoryModel;

class ProductModel extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_product_record';

    protected $primaryKey = 'ProductID';

    protected $fillable = [
        'product_code', 
        'product_name',
        'product_price', 
        'product_category', 
        'product_quantity',
        'product_status',
        'created_by',
        'date_created',
        'modified_by', 
        'date_modified',
    ];

    public function category() {
        return $this->belongsTo(ProductCategoryModel::class, 'product_category', 'CategoryID');
    }

    public function getCategoryNameAttribute() {
        return $this->category ? $this->category->category : null;
    }

    protected $appends = ['category_name'];
}

