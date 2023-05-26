<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Usuario\ModelUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Response;

class UserController extends Controller
{
    protected $_objUsuario;

    public function __construct()
    {
        $this->_objUsuario = new ModelUsuario();

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!UserController::isLogged()) {
            return redirect('/login');
        }
        
        $usuarios = $this->_objUsuario->all();

        return view('user/index', compact('usuarios'));
    }

    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Session::regenerate();
            $user = Auth::user();
            Session::put('usuario', $user);
            return Response::json(['status' => 'sucess', 'message' => 'Logado com sucesso']); 
        } else {
            return Response::json(['status' => 'error', 'message' => 'Usuário ou senha inválidos']); 
        }


    }
    
    /**
     * Display a listing of the resource.
     */
    public function loginMe()
    {
        return view('user/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->password != $request->password_confirm) {
            return Response::json(['status' => 'error', 'message' => 'As senhas não batem']); 
        }

        $criptPassword = Hash::make($request->password);
        
        $user = new ModelUsuario();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $criptPassword;
        $user->status = 'ativo';
        $user->save();

        return Response::json(['status' => 'success', 'message' => 'Salvo com sucesso']); 
    }

    public function logoff()
    {
        Session::flush();
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->_objUsuario->find($id);

        return Response::json([
            'user_id' => $user->id,
            'user_nome' => $user->name,
            'user_email' => $user->email,
            'user_status' => $user->status,
            'status' => 'success',
            'message' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->password != $request->password_confirm) {
            return Response::json(['status' => 'error', 'message' => 'As senhas não batem']); 
        }

        $criptPassword = Hash::make($request->password);
        
        $this->_objUsuario->where(['id' => $id])->update(['name' => $request->name, 'email' => $request->email, 'password' => $criptPassword, 'status' => 'ativo']);

        return Response::json(['status' => 'success', 'message' => 'Salvo com sucesso']); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->_objUsuario->destroy($id)) {
            return Response::json(['status' => 'error', 'message' => 'Erro ao apagar']);
        }

        return Response::json(['status' => 'success', 'message' => 'Apagado com sucesso!']);
    }

    public static function isLogged() {
        if (Session::has('usuario')) {
            return true;
        }
        return false;
    }
}
