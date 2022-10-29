<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Minuman extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "category_minuman";
    protected $primaryKey = "id_";
    public $incrementing = true;
    public $timestamps = true;
}
