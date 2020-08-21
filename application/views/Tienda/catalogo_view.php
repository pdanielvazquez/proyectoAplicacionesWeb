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

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

          <?
          if ($productos!=false) {
            foreach ($productos->result() as $producto) {
              if ($categoria!='Hombres' && $categoria!='Mujeres' ) {
                $categoria = 'Niños';
              }
              if ($producto->estado==1 && $producto->categoria==$categoria) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?= base_url("uploads/productos/$producto->imagen") ?>" alt=""></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="#"><?= $producto->nombre ?></a>
                      </h4>
                      <h5>$<?= number_format($producto->precio, 2) ?></h5>
                      <p class="card-text">
                        Categoria: <strong><?= $producto->categoria ?></strong><br>
                        <?
                        if ($producto->descripcion!='') {
                          echo $producto->descripcion;
                        }
                        else
                        {
                          echo "No hay descripción de este producto";
                        }
                        ?>
                      </p>
                    </div>
                    <div class="card-footer centrado">
                      <a href="<?= base_url('index.php/Tienda/agregar_producto/'.$producto->id_producto) ?>" title="Agregar producto" class="btn btn-info">Comprar</a>
                    </div>
                  </div>
                </div>
                <?
              }
            }
          }
          ?>




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
