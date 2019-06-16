<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    public $timestamps = false;
    
    public $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'remember_identifier'
    ];


}