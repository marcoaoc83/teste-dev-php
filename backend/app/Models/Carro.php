<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = "carros";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','marca_id', 'modelo', 'ano'
    ];
    public function Marca()
    {
        return $this->belongsTo(Marca::class,'marca_id');
    }
}
