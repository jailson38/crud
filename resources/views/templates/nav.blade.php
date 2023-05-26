@section('nav')    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Sistema administrativo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="veiculos">Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categorias">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logoff">Logoff</a>
                </li>
        </ul>
        </div>
    </nav>
@endsection
  