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
}
