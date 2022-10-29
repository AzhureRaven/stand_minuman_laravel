<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minuman extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "minuman";
    protected $primaryKey = "id_minuman";
    public $incrementing = true;
    public $timestamps = true;
}
