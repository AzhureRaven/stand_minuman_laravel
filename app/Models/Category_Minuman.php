<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_Minuman extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "category_minuman";
    protected $primaryKey = "id_";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_category_minuman',
        'nama'
    ];

    public function Minuman(){
        return $this->hasMany(Minuman::class,"id_category_minuman","id_category_minuman");
    }
}
