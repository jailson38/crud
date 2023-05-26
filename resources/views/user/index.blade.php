@extends('templates.template')
@extends('templates.nav')
@section('content')
    <h1 class="text-center mt-3">Lista de Usuarios</h1>
    <hr class='mb-0'>
    <div class="text-right mr-3">
        <button type="button" class="btn btn-success mt-3 mb-2" data-toggle="modal" data-target="#modal-usuario-create">Cadastrar</button>
    </div>
    <div class="col-12 m-auto">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="sortable" data-column="name">Nome</th>
                <th scope="col" class="sortable" data-column="vl_diaria">E-mail</th>
                <th scope="col" class="sortable" data-column="vl_hora">Status</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($usuarios as $usuario)
                @php
                    $i++;
                @endphp
                <tr>
                    <th>{{$i}}</th>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->status}}</td>
                    <td>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-usuario-read" onclick="getUserData({{$usuario->id}})">Ver</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-usuario-create" onclick="editUser({{$usuario->id}})">Editar</button>
                        <button class="btn btn-danger" onclick="deleteUser({{$usuario->id}})">Deletar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal para read --}}
    <div class="modal fade" id="modal-usuario-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes da Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome: </strong><span id="user-nome"></span></p>
                    <p><strong>Email: </strong><span id="user-email"></span></p>
                    <p><strong>Status: </strong><span id="user-status"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para create --}}
    <div class="modal fade" id="modal-usuario-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Cadastro de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="usuarios-create" action="store" method="post">
                        @csrf
                        <input type="text" hidden id="usuario_id" value="0">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input required type="text" class="form-control placa-input" id="name" placeholder="Digite o nome">
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                            <input required type="email" class="form-control email" id="email" placeholder="Digite email" data-inputmask>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input required type="password" class="form-control" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número, um caractere especial e ter no mínimo 8 caracteres" placeholder="Digite a senha">
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Confirme a senha</label>
                            <input required type="password" class="form-control" id="password_confirm" oninput="checkPassword()" placeholder="Confirme a senha">
                            <div id="password_match" style="display: none; color: red;">As senhas não coincidem.</div></div>
                        <div class='text-right'>
                            <button type="button" class="btn btn-secondary close-create" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  

    <!-- Modal de sucesso -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Veículo Salvo com Sucesso!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>O dado foi salvo corretamente em nosso sistema.</p>
            <p>A modal será fechada automaticamente em <span id="countdown">3</span> segundos.</p>
            </div>
        </div>
        </div>
    </div>
    <script src="assets/js/usuarios.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
@endsection