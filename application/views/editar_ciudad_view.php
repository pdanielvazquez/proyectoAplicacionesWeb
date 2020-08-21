<!DOCTYPE html>
<html>
<head>
	<title>Editar ciudad</title>
</head>
<body>

	<nav>
		<a href="nueva_ciudad" title="Agregar nueva ciudad">Agregar ciudad</a>
		<a href="ciudades" title="Ver el listado completo de ciudades">Ciudades</a>
		<a href="logout" title="Cerrar mi sesión">Salir</a>
	</nav>

	<h2>Editar ciudad</h2>

	<?
	if ($ciudad!=false) {
		$city = $ciudad->row(0);
	}

	if ($edicion==1) {
		?>
		<h1>Los datos de la ciudad fueron editados exitosamente</h1>
		<?
	}

	?>

	<form action="<?= base_url('index.php/Home/guardar_edicion') ?> " method="post">
		<input type="hidden" name="id" value="<?= $city->ID ?>">
		<div>
			<label>Nombre de la Ciudad</label>
			<input type="text" name="ciudad" id="ciudad" placeholder="Escriba aquí" required="required" value="<?= $city->Name ?>">
		</div>
		<div>
			<label>País</label>
			<select name="pais" id="pais" required="required">
				<option value="">-Seleccione-</option>
				<?
				if ($countries!=false) {
					foreach ($countries->result() as $country) {
						$select = '';
						if ($country->Code == $city->CountryCode) {
							$select = ' selected="selected" ';
						}
						?>
						<option <?= $select ?> value="<?= $country->Code ?>" ><?= $country->Name ?></option>
						<?
					}
				}
				?>
			</select>
		</div>
		<div>
			<label>Nombre de la Provincia/Estado</label>
			<input type="text" name="estado" id="estado" placeholder="Escriba aquí" required="required" value="<?= $city->District ?>">
		</div>
		<div>
			<label>Población</label>
			<input type="number" name="poblacion" id="poblacion" placeholder="0" min="0" required="required" value="<?= $city->Population ?>">
		</div>
		<div>
			<button name="btn-aceptar" id="btn-aceptar">Aceptar</button>
		</div>
	</form>

</body>
</html>