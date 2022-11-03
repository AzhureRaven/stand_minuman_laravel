<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diskon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "diskon";
    protected $primaryKey = "id_diskon";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_diskon',
        'nama',
        'potongan'
    ];

    public function HTrans(){
        return $this->hasMany(HTrans::class,"id_diskon","id_diskon");
    }
}
