<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locadora de Carros</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Locadora de Carros</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/veiculos">Área Administrativa</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-md-10">
        
        <!-- Reservas -->
        <div class="reservation-container bg-light p-4 mb-4">
          <h3 class="text-center">Reserva de Veículos</h3>
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="start-date">Data de Início</label>
                <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="start-date" required>
              </div>
              <div class="form-group col-md-6">
                <label for="end-date">Data de Fim</label>
                <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="end-date" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="pickup-location">Local de Retirada</label>
                <select class="form-control">
                  <option value="CGH">Aeroporto Internacional de São Paulo-Congonhas (CGH)</option>
                  <option value="GRU">Aeroporto Internacional de São Paulo-Guarulhos (GRU)</option>
                  <option value="GIG">Aeroporto Internacional do Rio de Janeiro-Galeão (GIG)</option>
                  <option value="BSB">Aeroporto Internacional de Brasília (BSB)</option>
                  <option value="CWB">Aeroporto Internacional de Curitiba (CWB)</option>
                  <option value="SSA">Aeroporto Internacional de Salvador (SSA)</option>
                  <option value="MAO">Aeroporto Internacional de MANAUS (MAO)</option>
                  <!-- Adicione mais opções aqui -->
                </select>             
              </div>
              <div class="form-group col-md-6">
                <label for="return-location">Local de Devolução</label>
                <select class="form-control">
                  <option value="CGH">Aeroporto Internacional de São Paulo-Congonhas (CGH)</option>
                  <option value="GRU">Aeroporto Internacional de São Paulo-Guarulhos (GRU)</option>
                  <option value="GIG">Aeroporto Internacional do Rio de Janeiro-Galeão (GIG)</option>
                  <option value="BSB">Aeroporto Internacional de Brasília (BSB)</option>
                  <option value="CWB">Aeroporto Internacional de Curitiba (CWB)</option>
                  <option value="SSA">Aeroporto Internacional de Salvador (SSA)</option>
                  <option value="MAO">Aeroporto Internacional de Manaus (MAO)</option>
                  <!-- Adicione mais opções aqui -->
                </select>               
              </div>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary">Fazer cotação</button>
            </div>
          </form>
        </div>

        <!-- Carousel -->
        <div class="carousel-container mb-5">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/compass.jpg" class="d-block w-100" alt="Carro 1">
              </div>
              <div class="carousel-item">
                <img src="img/creta.jpg" class="d-block w-100" alt="Carro 2">
              </div>
              <div class="carousel-item">
                <img src="img/tcross.webp" class="d-block w-100" alt="Carro 3">
              </div>
              <div class="carousel-item">
                <img src="img/veloster.webp" class="d-block w-100" alt="Carro 4">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Próximo</span>
            </a>
          </div>
        </div>

        <!-- Section SUV -->
        <section class="py-5">
          <div class="container">
            <h2 class="text-center mb-4">Carros SUV</h2>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="card shadow">
                  <img src="img/land.jpeg" class="card-img-top" alt="SUV 1">
                  <div class="card-body">
                    <h5 class="card-title">Land Rover Discovery</h5>
                    <p class="card-text">O Land Rover Discovery é um SUV icônico conhecido por sua capacidade off-road e luxo refinado.</p>
                    <a href="#" class="btn btn-primary">Saiba mais</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card shadow">
                  <img src="img/pathfinder.jpeg" class="card-img-top" alt="SUV 2">
                  <div class="card-body">
                    <h5 class="card-title">Nissan Pathfinder</h5>
                    <p class="card-text">O Nissan Pathfinder é um SUV versátil e robusto que combina conforto, capacidade off-road e tecnologia avançada.</p>
                    <a href="#" class="btn btn-primary">Saiba mais</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card shadow">
                  <img src="img/edge.jpeg" class="card-img-top" alt="SUV 3">
                  <div class="card-body">
                    <h5 class="card-title">Ford Edge</h5>
                    <p class="card-text">O Ford Edge é um SUV premium que combina elegância, desempenho e tecnologia em um único veículo.</p>
                    <a href="#" class="btn btn-primary">Saiba mais</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
