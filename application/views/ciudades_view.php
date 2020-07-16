<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ciudades</title>
</head>
<body>

	<h2>Ciudades</h2>

	
	<?
	if ($cities!=false){
		?>
		<table border="1">
			<thead>
				<tr>
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
			echo "<tr><td>".++$contador."</td><td>$city->Name</td><td>$city->Population</td></tr>";
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