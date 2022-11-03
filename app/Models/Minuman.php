<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minuman extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "minuman";
    protected $primaryKey = "id_minuman";
    public $incrementing = true;
    public $timestamps = true;

    public function Category_Minuman(){
        return $this->belongsTo(Category_Minuman::class,"id_category_minuman","id_category_minuman");
    }

    public function DTrans(){
        return $this->hasMany(DTrans::class,"id_minuman","id_minuman");
    }

}
