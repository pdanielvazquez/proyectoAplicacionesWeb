<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TiendaSHOP</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>assets1/css/estilos_login.css" rel="stylesheet">
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Iniciar sesión</h5>
            <form class="form-signin" action="verificar" method="post" >
              <div class="form-label-group">
                <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo electrónico" required="required" autofocus>
                <label for="correo">Correo electrónico</label>
              </div>

              <div class="form-label-group">
                <input type="date" id="password" name="password" class="form-control" placeholder="Contraseña" required="required">
                <label for="password">Contraseña</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>