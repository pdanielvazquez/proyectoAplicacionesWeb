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
  <link href="<?= base_url() ?>assets1/css/estilos.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets1/fontawesome/css/all.css" rel="stylesheet">


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

          <li class="nav-item active">
            <a href="<?= base_url('index.php/Tienda/carrito') ?>" title="Ver carrito de compra">
              <span class="contador"><?= $conta ?></span>
              <i class="fas fa-shopping-bag bolsa"></i>
            </a>
          </li>

          <?
          if (!isset($_SESSION['id_user'])) {

            ?>
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url() ?>">Catalogo
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url("index.php/Tienda/registro") ?>">Registrarse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url("index.php/Tienda/login") ?>" target="_blank">Entrar</a>
            </li>
            <?
          }
          else{
            $usuario = $usuarios->row(0); 
            ?>
            <li class="nav-item name-user">
              <?= "$usuario->nombre $usuario->a_paterno $usuario->a_materno" ?>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url("index.php/Tienda/logout") ?>" target="_blank">Salir</a>
            </li>
            <?
          }
          ?>

          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">TiendaSHOP</h1>
        <div class="list-group">
          <a href="<?= base_url('index.php/Tienda/index/Mujeres') ?>" class="list-group-item">Mujeres</a>
          <a href="<?= base_url('index.php/Tienda/index/Hombres') ?>" class="list-group-item">Hombres</a>
          <a href="<?= base_url('index.php/Tienda/index/Niños') ?>" class="list-group-item">Niños</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row" style="margin: 20px 0;">

          <?
          $producto = false;
          if ($productos!=false) {
            $producto = $productos->row(0);
          }
          ?>

          <div class="col-xs-6 col-md-6">
            <img src="<?= base_url("uploads/productos/$producto->imagen") ?>" title="Producto" style="width: 100%">
            
          </div>

          <div class="col-xs-6 col-md-6" >

            <form method="post" action="<?= base_url('index.php/Tienda/agregar_bolsa/'.$producto->id_producto) ?>">
            
              <h1><?= $producto->nombre ?></h1>
              <h3>Categoria: <?= $producto->categoria ?></h3>
              <h3>Precio: $<?= number_format($producto->precio, 2) ?></h3>

              <div class="form-group">
                <label>Talla</label>
                <select name="talla" id="talla" class="form-control" required="required">
                <?
                switch ($producto->categoria) {
                  case 'Hombres':
                    for ($i=26; $i < 31 ; $i++) { 
                      if ($existencias!=false) {
                        foreach ($existencias->result() as $existencia) {
                          if ($existencia->talla == $i && $existencia->cantidad>0) {
                            ?>
                            <option><?= $i ?></option>
                            <?
                          }
                        }
                      }
                    }
                    break;
                  case 'Mujeres':
                    for ($i=22; $i < 26 ; $i++) { 
                      if ($existencias!=false) {
                        foreach ($existencias->result() as $existencia) {
                          if ($existencia->talla == $i && $existencia->cantidad>0) {
                            ?>
                            <option><?= $i ?></option>
                            <?
                          }
                        }
                      }
                    }
                    break;
                  case 'Niños':
                    for ($i=16; $i < 21 ; $i++) { 
                      if ($existencias!=false) {
                        foreach ($existencias->result() as $existencia) {
                          if ($existencia->talla == $i && $existencia->cantidad>0) {
                            ?>
                            <option><?= $i ?></option>
                            <?
                          }
                        }
                      }
                    }
                    break;
                }
                ?>
                </select>
              </div>

              <div class="form-group">
                <label>Cantidad</label>
                <select name="cantidad" id="cantidad" class="form-control" required="required">
                  <?
                  for ($i=1; $i <=5 ; $i++) { 
                    ?>
                    <option><?= $i ?></option>
                    <?
                  }
                  ?>
                </select>
              </div>
              <div>
                <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
              </div>
            </form>

            <?
            //print_r($_SESSION['productos']);
            ?>

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
