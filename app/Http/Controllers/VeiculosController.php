<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Models\Veiculos\ModelVeiculos;
use App\Models\Veiculos\ModelVeiculosCategoria;

class VeiculosController extends Controller
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
        $veiculos = $this->_objVeiculo->all()->sortBy($sortBy);
        $categorias = $this->_objVeiculoCategoria->all();

        return view('veiculos/index', compact('veiculos', 'categorias'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $directory = '';
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $directory = 'img/upload/' . $imagem->hashName();
            $imagem->move('img/upload', $imagem->hashName());
        }

        $this->_objVeiculo->create([
            'name' => $request->veiculo_nome,
            'placa' => $request->placa,
            'montadora' => $request->montadora,
            'descricao' => $request->descricao,
            'observacoes' => $request->observacoes,
            'fk_categoria' => $request->categoria,
            'image' => $directory,
        ]);


        return Response::json(['status' => 'success', 'message' => 'Criado com sucesso!']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $veiculo = $this->_objVeiculo->find($id);
        $categoria = $veiculo->find($veiculo->id)->relCategoria;

        return Response::json([
            'veiculo_id' => $veiculo->id,
            'veiculo_nome' => $veiculo->name,
            'veiculo_montadora' => $veiculo->montadora,
            'veiculo_placa' => $veiculo->placa,
            'veiculo_descricao' => $veiculo->descricao,
            'veiculo_observacoes' => $veiculo->observacoes,
            'veiculo_image' => $veiculo->image,
            'veiculo_categoria_id' => $categoria->id,
            'veiculo_categoria_nome' => $categoria->name,
            'veiculo_categoria_vl_hora' => $categoria->vl_hora,
            'veiculo_categoria_vl_diaria' => $categoria->vl_diaria,
            'veiculo_categoria_vl_semana' => $categoria->vl_semana,
            'veiculo_categoria_vl_mes' => $categoria->vl_mes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $veiculo = $this->_objVeiculo->find($id);
        $directory = $veiculo->image;

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $directory = 'img/upload/' . $imagem->hashName();
            $imagem->move('img/upload', $imagem->hashName());
        }

        $this->_objVeiculo->where(['id' => $id])->update([
            'name' => $request->veiculo_nome,
            'montadora' => $request->montadora,
            'descricao' => $request->descricao,
            'observacoes' => $request->observacoes,
            'fk_categoria' => $request->categoria,
            'image' => $directory
        ]);

        return Response::json(['status' => 'success', 'message' => 'Criado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->_objVeiculo->destroy($id)) {
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
