<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTrans extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "htrans";
    protected $primaryKey = "no_nota";
    public $incrementing = true;
    public $timestamps = true;

    public function DTrans(){
        return $this->hasMany(DTrans::class,"no_nota","no_nota");
    }

    public function Member(){
        return $this->hasOne(Member::class,"id_member","id_member");
    }

    public function Diskon(){
        return $this->hasOne(Diskon::class,"id_diskon","id_diskon");
    }

    public function Users(){
        return $this->hasOne(Users::class,"id_users","id_users");
    }
}
