<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'product_stock',
        'product_status',
        'created_by',
        'date_created',
        'modified_by', 
        'date_modified',
    ];
}
