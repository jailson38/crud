<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locadora</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    @yield('clientNav')
    <div class="mb-3"></div>
    <div class="container">
        @yield('content')
    </div>
    <footer class="bg-dark text-light py-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h4>Locadora de Veículos</h4>
              <p>Endereço: Av. Exemplo, 123 - Cidade, Estado</p>
              <p>Telefone: (00) 1234-5678</p>
            </div>
          </div>
        </div>
      </footer>
</body>
</html>