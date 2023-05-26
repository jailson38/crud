<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistema de Locação</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card shadow animate__animated animate__fadeInDown">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login</h2>
            <form id="login">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" placeholder="Digite seu email">
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" class="form-control" placeholder="Digite sua senha">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/usuarios.js"></script>
</body>
</html>
