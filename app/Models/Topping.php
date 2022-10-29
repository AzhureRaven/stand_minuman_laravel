<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "topping";
    protected $primaryKey = "id_topping";
    public $incrementing = true;
    public $timestamps = true;

    public function DTrans(){
        return $this->hasMany(DTrans::class,"id_topping","id_topping");
    }
}
