<?php

namespace App\Models\Veiculos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelVeiculosCategoria extends Model
{
    use SoftDeletes;
    protected $table = 'veiculos_categoria';
    protected $fillable = ['name', 'vl_hora', 'vl_diaria', 'vl_semana', 'vl_mes', 'created_at'];

    /**
     * Relatioship from VeiculosCategoria and Veiculos
     *
     **/
    public function relVeiculos()
    {
        return $this->hasMany('App\Models\Veiculos\ModelVeiculosCategoria', 'fk_categoria', 'id');
    }
}
