<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "member";
    protected $primaryKey = "id_member";
    public $incrementing = true;
    public $timestamps = true;

    public function HTrans(){
        return $this->hasMany(HTrans::class,"id_member","id_member");
    }
}
