<?php

namespace App\Models\Veiculos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ModelVeiculos extends Model
{
    use SoftDeletes;
    protected $table = 'veiculos';
    protected $fillable = ['name', 'montadora', 'placa', 'image', 'fk_categoria', 'descricao', 'observacoes', 'created_at'];

    /**
     * Relatioship from Veiculos and VeiculosCategoria
     *
     **/
    public function relCategoria()
    {
        return $this->hasOne('App\Models\Veiculos\ModelVeiculosCategoria', 'id', 'fk_categoria');
    }
}
