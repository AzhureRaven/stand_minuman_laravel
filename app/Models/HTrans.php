<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HTrans extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "htrans";
    protected $primaryKey = "no_nota";
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'no_nota',
        'id_users',
        'id_diskon',
        'id_member',
        'subtotal',
        'potongan',
        'total',
        'tanggal'
    ];

    public function DTrans(){
        return $this->hasMany(DTrans::class,"no_nota","no_nota");
    }

    public function Member(){
        return $this->belongsTo(Member::class,"id_member","id_member");
    }

    public function Diskon(){
        return $this->belongsTo(Diskon::class,"id_diskon","id_diskon");
    }

    public function Users(){
        return $this->belongsTo(Users::class,"id_users","id_users");
    }
}
