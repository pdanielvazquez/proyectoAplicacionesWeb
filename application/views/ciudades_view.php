<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ciudades</title>
</head>
<body>

	<nav>
		<a href="nueva_ciudad" title="Agregar nueva ciudad">Agregar ciudad</a>
		<a href="ciudades" title="Ver el listado completo de ciudades">Ciudades</a>
		<a href="logout" title="Cerrar mi sesión">Salir</a>
	</nav>

	<h2>Ciudades</h2>
	
	<?
	if ($cities!=false){
		?>
		<table border="1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Ciudad</th>
					<th>Estado/Provincia</th>
					<th>Población</th>
					<th>Fotografía</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
		<tbody>
		<?
		$contador = 0;
		//echo "Si hay ciudades";
		foreach ($cities->result() as $city) {
			//echo "<tr><td>".++$contador."</td><td>$city->Name</td><td>$city->District</td><td>$city->Population</td></tr>";
			?>
			<tr>
				<td><?= ++$contador ?></td>
				<td><?= $city->Name ?></td>
				<td><?= $city->District ?></td>
				<td><?= $city->Population ?></td>
				<td>
					<?
					if ($city->image!='') {
						?>
						<a href="<?= base_url("/uploads/ciudades/$city->image") ?>" title="Ver imagen" target="_blank">
							<img src="<?= base_url("/uploads/ciudades/$city->image") ?>" style="width: 100px; height: 40px;">
						</a>
						<?
					}
					else{
						echo "Imagen no disponible";
					}
					?>
				</td>
				<td>
					<a href="editar_ciudad/<?= $city->ID ?>/0" title="Edición de información de una ciudad">Editar</a>
					<a href="eliminar_ciudad/<?= $city->ID ?>" title="Eliminar una ciudad" class="btn-borrar" data-city="<?= $city->Name ?>" >Borrar</a>
				</td>
			</tr>
			<?
		}
		?>
			</tbody>
		</table>
		<?
	}
	else
		echo "No hay información";
	?>
		

</body>
</html>


<script src="<?= base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script>
$(function(){
	//alert("Hola desde Jquery");

	$('.btn-borrar').on('click', function(){
		var ciudad = $(this).attr('data-city');
		if (confirm('Se va a eliminar la ciudad de '+ciudad+', \u00BFDesea continuar?')) {
			alert("La ciudad se va a eliminar");
		}
		else{
			alert("Operación cancelada");
			return false;
		}
	})

});
</script>