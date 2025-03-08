<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginModel extends Authenticatable {
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_user_access';

    protected $primaryKey = 'UserID';

    protected $fillable = [
        'first_name', 
        'last_name',
        'user_name', 
        'user_email', 
        'contact_number',
        'password', 
        'user_role', 
        'user_status', 
        'access_level',
        'modified_by', 
        'date_modified'
    ];
}

