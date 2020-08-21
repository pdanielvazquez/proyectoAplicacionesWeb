<!DOCTYPE html>
<html>
<head>
	<title>Nueva ciudad</title>
</head>
<body>

	<nav>
		<a href="nueva_ciudad" title="Agregar nueva ciudad">Agregar ciudad</a>
		<a href="ciudades" title="Ver el listado completo de ciudades">Ciudades</a>
		<a href="logout" title="Cerrar mi sesión">Salir</a>
	</nav>

	<h2>Agregar una nueva ciudad</h2>

	<form action="guardar_ciudad" method="post" enctype="multipart/form-data">
		<div>
			<label>Nombre de la Ciudad</label>
			<input type="text" name="ciudad" id="ciudad" placeholder="Escriba aquí" required="required">
		</div>
		<div>
			<label>Imagen de la Ciudad</label>
			<input type="file" name="userfile" value="archivo" required="required">
		</div>
		<div>
			<label>País</label>
			<select name="pais" id="pais" required="required">
				<option value="">-Seleccione-</option>
				<?
				if ($countries!=false) {
					foreach ($countries->result() as $country) {
						?>
						<option value="<?= $country->Code ?>" ><?= $country->Name ?></option>
						<?
					}
				}
				?>
			</select>
		</div>
		<div>
			<label>Nombre de la Provincia/Estado</label>
			<input type="text" name="estado" id="estado" placeholder="Escriba aquí" required="required">
		</div>
		<div>
			<label>Población</label>
			<input type="number" name="poblacion" id="poblacion" placeholder="0" min="0" required="required">
		</div>
		<div>
			<button name="btn-aceptar" id="btn-aceptar">Aceptar</button>
		</div>
	</form>

</body>
</html>