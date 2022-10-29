<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "member";
    protected $primaryKey = "id_member";
    public $incrementing = true;
    public $timestamps = true;
}
