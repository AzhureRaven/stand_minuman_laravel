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
}
