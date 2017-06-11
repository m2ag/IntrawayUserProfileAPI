<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    
    protected $fillable = [
        'id', 'name', 'email', 'image',
    ];
    
    protected $hidden = ['created_at', 'updated_at'];
}
