<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DTrans extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = "dtrans";
    protected $primaryKey = "no_nota";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'no_nota',
        'id_minuman',
        'id_topping',
        'jumlah',
        'subtotal_minuman',
        'subtotal_topping',
        'subtotal'
    ];

    public function HTrans(){
        return $this->belongsTo(HTrans::class,"no_nota","no_nota");
    }

    public function Minuman(){
        return $this->belongsTo(Minuman::class,"id_minuman","id_minuman");
    }

    public function Topping(){
        return $this->belongsTo(Topping::class,"id_topping","id_topping");
    }
}
