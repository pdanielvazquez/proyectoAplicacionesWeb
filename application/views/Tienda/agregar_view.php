<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TiendaSHOP</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>assets1/css/shop-homepage.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url() ?>assets1/css/estilos.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">TiendaSHOP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item name-user">
            <?
            $nombre = 'Nombre';
            if ($usuarios!=false) {
              $usuario = $usuarios->row(0);
              $nombre = "$usuario->nombre $usuario->a_paterno $usuario->a_materno";
            }
            echo $nombre;
            ?>
          </li>
        </ul>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Menú</h1>
        <div class="list-group">
          <a href="<?= base_url('index.php/Tienda/agregar') ?>" class="list-group-item">Agregar nuevo</a>
          <a href="<?= base_url('index.php/Tienda/registrados') ?>" class="list-group-item">Catalogo general</a>
          <a href="<?= base_url('index.php/Tienda/logout') ?>" class="list-group-item">Salir</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">

          <div class="col-xs-12 col-md margenes-1">

            <h2>Registro de un nuevo producto</h2>

            <form action="guardar_producto" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nombre del modelo *</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba aquí" required="required">
              </div>
              <div class="form-group">
                <label>Categoría *</label>
                <select name="categoria" id="categoria" class="form-control">
                  <option>Hombres</option>
                  <option>Mujeres</option>
                  <option>Niños</option>
                </select>
              </div>
              <div class="form-group">
                <label>Marca *</label>
                <select name="marca" id="marca" class="form-control">
                  <option>Nike</option>
                  <option>Adidas</option>
                  <option>Panam</option>
                  <option>Puma</option>
                </select>
              </div>
              <div class="form-group">
                <label>Precio *</label>
                <input type="number" name="precio" id="precio" class="form-control" value="00.0" step="0.1" min="0" required="required">
              </div>
              <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Escribir descripción"></textarea>
              </div>
              <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="userfile" id="userfile" value="archivo">
              </div>
              <div>
                <button type="submit" class="btn btn-primary" name="aceptar" id="aceptar">Aceptar</button>
              </div>
            </form>
          </div>


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; TiendaSHOP 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url() ?>assets1/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
