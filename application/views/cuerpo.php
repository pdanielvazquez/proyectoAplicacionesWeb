<!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $titulo ?>
          <small><?= $subtitulo ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-primary">
          <div class="box-header">
            <h4 class="box-title">
              Ciudades registradas
            </h4>
          </div>
          <div class="box-body">
            <?
            if ($cities!=false){
              ?>
              <table class="table table-hover table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>No.</th>
                    <th>Ciudad</th>
                    <th>Población</th>
                  </tr>
                </thead>
              <tbody>
              <?
              $contador = 0;
              //echo "Si hay ciudades";
              foreach ($cities->result() as $city) {
                echo "<tr><td><button type='button' class='btn btn-lg btn-info btn-agregar' id='btn-agregar-$contador'><i class='fa fa-cart-plus'></i></button></td><td>".++$contador."</td><td>$city->Name</td><td>$city->Population</td></tr>";
                if ($contador>100) {
                  break;
                }
              }
              ?>
                </tbody>
              </table>
              <?
            }
            
            ?>
          </div>
          
        </div>

        

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->