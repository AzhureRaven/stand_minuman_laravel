<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "users";
    protected $primaryKey = "id_users";
    public $incrementing = true;
    public $timestamps = true;

    public function HTrans(){
        return $this->hasMany(HTrans::class,"id_users","id_users");
    }
}
