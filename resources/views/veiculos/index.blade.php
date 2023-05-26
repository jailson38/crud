@extends('templates.template')
@extends('templates.nav')
@section('content')
<h1 class="text-center mt-3">Lista de Veículos</h1>
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
            <th scope="col" class="sortable" data-column="fk_categoria">Categoria</th>
            <th scope="col" class="sortable" data-column="placa">Placa</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 0;
        @endphp
        @foreach ($veiculos as $veiculo)
            @php
                $i++;
                $categoria = $veiculo->find($veiculo->id)->relCategoria;
            @endphp
            <tr>
                <th>{{$i}}</th>
                <td>{{$veiculo->name}}</td>
                <td>{{$categoria->name}}</td>
                <td>{{$veiculo->placa}}</td>
                <td>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-veiculo-read" onclick="getVeiculoData({{$veiculo->id}})">Ver</button>
                    <button class="btn btn-primary" onclick="editVeiculo({{$veiculo->id}})" data-toggle="modal" data-target="#modal-veiculo-create">Editar</button>
                    <button class="btn btn-danger" onclick="deleteVeiculo({{$veiculo->id}})">Deletar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Veículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nome: </strong><span id="veiculo-nome"></span></p>
                <p><strong>Montadora: </strong><span id="veiculo-montadora"></span></p>
                <p><strong>Placa: </strong><span id="veiculo-placa"></span></p>
                <p><strong>Categoria: </strong><span id="veiculo-categoria-nome"></span></p>
                <p><strong>Descrição: </strong><span id="veiculo-descricao"></span></p>
                <p><strong>Valor/hora: </strong><span id="veiculo-categoria-vl_hora"></span></p>
                <p><strong>Valor/diaria: </strong><span id="veiculo-categoria-vl_diaria"></span></p>
                <p><strong>Valor/semana: </strong><span id="veiculo-categoria-vl_semana"></span></p>
                <p><strong>Valor/mes: </strong><span id="veiculo-categoria-vl_mes"></span></p>
                <p><strong>Observações: </strong><span id="veiculo-observacoes"></span></p>
                <p><strong>Imagem:</strong></p>
                <img class="m-auto d-block mx-auto border border-dark" id="veiculo-imagem" src="" alt="Imagem do veículo">
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
            <h5 class="modal-title" id="myModalLabel">Cadastro de Veículo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="veiculos-create" action="save" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden id="veiculo_id" value="0">
                    <div class="form-group">
                    <label for="nome">Montadora</label>
                    <select required id="montadora" name="montadora"  class="form-control">
                        <option value="">Selecione a montadora</option>
                    </select>            
                    </div>
                    <div class="form-group">
                        <label for="nome">Veículo</label>
                        <select required id="veiculo_nome" name="veiculo_nome" class="form-control">
                            <option value="">Selecione o veículo</option>
                    </select>               
                    </div>
                    <div class="form-group">
                    <label for="placa">Placa</label>
                    <input required type="text" class="form-control placa-input" id="placa" name="placa" placeholder="Digite a placa" data-inputmask>
                    </div>
                    <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select required class="form-control" id="categoria" name="categoria">
                        <option value="">Selecione a categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" id="imagem" name="imagem">
                    </div>
                    <br>
                    <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
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

<script src="assets/js/veiculos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
@endsection