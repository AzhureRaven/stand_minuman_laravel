<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTrans extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "dtrans";
    protected $primaryKey = "no_nota";
    public $incrementing = true;
    public $timestamps = true;

    public function HTrans(){
        return $this->hasOne(HTrans::class,"no_nota","no_nota");
    }

    public function Minuman(){
        return $this->hasOne(Minuman::class,"id_minuman","id_minuman");
    }

    public function Topping(){
        return $this->hasOne(Topping::class,"id_topping","id_topping");
    }
}
