<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "users";
    protected $primaryKey = "id_users";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_users',
        'username',
        'password',
        'privilege'
    ];

    public function HTrans(){
        return $this->hasMany(HTrans::class,"id_users","id_users");
    }
}
