@php
    use App\Http\Controllers\CategoriaController;
@endphp
@extends('templates.template')
@extends('templates.nav')
@section('content')
<h1 class="text-center mt-3">Lista de Categorias</h1>
<hr class='mb-0'>
<div class="text-right mr-3">
    <button type="button" class="btn btn-success mt-3 mb-2" data-toggle="modal" data-target="#modal-veiculo-create">Cadastrar</button>
</div>
<div class="col-12 m-auto">
    <table class="table table-striped table-bordered text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="sortable" data-column="name">Nome</th>
            <th scope="col" class="sortable" data-column="vl_diaria">R$/Diária</th>
            <th scope="col" class="sortable" data-column="vl_hora">R$/Hora</th>
            <th scope="col" class="sortable" data-column="vl_semana">R$/Semana</th>
            <th scope="col" class="sortable" data-column="vl_mes">R$/Mês</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 0;
        @endphp
        @foreach ($categorias as $categoria)
            @php
                $i++;
            @endphp
            <tr>
                <th>{{$i}}</th>
                <td>{{$categoria->name}}</td>
                <td>{{CategoriaController::moedaToBr($categoria->vl_diaria)}}</td>
                <td>{{CategoriaController::moedaToBr($categoria->vl_hora)}}</td>
                <td>{{CategoriaController::moedaToBr($categoria->vl_semana)}}</td>
                <td>{{CategoriaController::moedaToBr($categoria->vl_mes)}}</td>
                <td>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-veiculo-read" onclick="getCategoriaData({{$categoria->id}})">Ver</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-veiculo-create" onclick="editCategoria({{$categoria->id}})">Editar</button>
                    <button class="btn btn-danger" onclick="deleteCategoria({{$categoria->id}})">Deletar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- Modal para read --}}
<div class="modal fade" id="modal-veiculo-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes da Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nome: </strong><span id="categoria-nome"></span></p>
                <p><strong>Valor/diaria: </strong><span id="categoria-vl_diaria"></span></p>
                <p><strong>Valor/hora: </strong><span id="categoria-vl_hora"></span></p>
                <p><strong>Valor/semana: </strong><span id="categoria-vl_semana"></span></p>
                <p><strong>Valor/mes: </strong><span id="categoria-vl_mes"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal para create --}}
<div class="modal fade" id="modal-veiculo-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Cadastro de categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categorias-create" action="store" method="post">
                    @csrf
                    <input required type="text" hidden id="categoria_id" value="0">
                    <div class="form-group">
                    <label for="placa">Nome</label>
                    <input required type="text" class="form-control placa-input" id="name" placeholder="Digite o nome da categoria">
                    </div>
                    <div class="form-group">
                    <label for="valor_diaria">Valor por Diária</label>
                        <input required type="text" class="form-control valor_diaria" id="valor_diaria" placeholder="Digite o valor por diária" data-inputmask>
                    </div>
                    <div class="form-group">
                    <label for="valor_hora">Valor por Hora</label>
                    <input type="text" class="form-control" id="valor_hora" placeholder="Digite o valor por hora">
                    </div>
                    <div class="form-group">
                    <label for="valor_semana">Valor por Semana</label>
                    <input type="text" class="form-control" id="valor_semana" placeholder="Digite o valor por semana">
                    </div>
                    <div class="form-group">
                    <label for="valor_mes">Valor por Mês</label>
                    <input type="text" class="form-control" id="valor_mes" placeholder="Digite o valor por mês">
                    </div>
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
        <p>O veículo foi salvo corretamente em nosso sistema.</p>
        <p>Agradecemos por utilizar nossos serviços e caso necessite de alguma assistência adicional, não hesite em entrar em contato conosco.</p>
        <p>A modal será fechada automaticamente em <span id="countdown">3</span> segundos.</p>
        </div>
    </div>
    </div>
</div>
<script src="assets/js/categorias.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
@endsection