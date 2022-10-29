<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "diskon";
    protected $primaryKey = "id_diskon";
    public $incrementing = true;
    public $timestamps = true;

    public function HTrans(){
        return $this->hasMany(HTrans::class,"id_diskon","id_diskon");
    }
}
