<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Models\Veiculos\ModelVeiculos;
use App\Models\Veiculos\ModelVeiculosCategoria;
use App\Http\Controllers\UserController;

class CategoriaController extends Controller
{
    protected $_objVeiculo;
    protected $_objVeiculoCategoria;

    public function __construct()
    {
        $this->_objVeiculo = new ModelVeiculos();
        $this->_objVeiculoCategoria = new ModelVeiculosCategoria();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!UserController::isLogged()) {
            return redirect('/login');
        }

        $sortBy = $request->input('sortBy') ?? 'id';
        $categorias = $this->_objVeiculoCategoria->all()->sortBy($sortBy);

        return view('categorias/index', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->_objVeiculoCategoria->create([
            'name' => $request->name,
            'vl_hora' => $request->valor_hora,
            'vl_diaria' => $request->valor_diaria,
            'vl_mes' => $request->valor_mes,
            'vl_semana' => $request->valor_semana,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        return Response::json(['status' => 'success', 'message' => 'Criado com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = $this->_objVeiculoCategoria->find($id);

        return Response::json([
            'status' => 'success',
            'categoria_id' => $categoria->id,
            'categoria_nome' => $categoria->name,
            'categoria_vl_hora' => $categoria->vl_hora,
            'categoria_vl_diaria' => $categoria->vl_diaria,
            'categoria_vl_semana' => $categoria->vl_semana,
            'categoria_vl_mes' => $categoria->vl_mes,
            'message' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->_objVeiculoCategoria->where(['id' => $id])->update([
            'name' => $request->name,
            'vl_hora' => $request->valor_hora,
            'vl_diaria' => $request->valor_diaria,
            'vl_mes' => $request->valor_mes,
            'vl_semana' => $request->valor_semana
        ]);

        return Response::json(['status' => 'success', 'message' => 'Criado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (count($this->_objVeiculo->where('fk_categoria', $id)->get()) > 0) {
            return Response::json(['status' => 'error', 'message' => 'Erro ao apagar! Existem veículos nesta categoria, considere apagar os veículos primeiro!']);
        }

        if (!$this->_objVeiculoCategoria->destroy($id)) {
            return Response::json(['status' => 'error', 'message' => 'Erro ao apagar']);
        }

        return Response::json(['status' => 'success', 'message' => 'Apagado com sucesso!']);
    }

    /**
     * retorna o valor float formatado em real.
     */
    public static function moedaToBr(float $valor): string {
        $valorFormatado = number_format($valor, 2, ',', '.');
        
        $valorFormatado = 'R$ ' . $valorFormatado;
        
        return $valorFormatado;
    }
    
}
