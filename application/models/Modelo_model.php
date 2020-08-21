<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Nuestro primer modelo
 */
class Modelo_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getCities(){
		$sql = "SELECT * from city ORDER BY Name";
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else
			return false;
	}

	public function getCountries(){
		$sql = "SELECT * from country ORDER BY Name";
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else
			return false;
	}

	public function setCity($nom, $cod, $edo, $pob, $img){
		$sql = "INSERT into city values('', '$nom', '$cod', '$edo', $pob, '$img')";
		$inserta = $this->db->query($sql);
	}

	public function getCity($id){
		$sql = "SELECT * from city WHERE ID = $id";
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else
			return false;
	}

	public function updateCity($id, $nom, $cod, $edo, $pob){
		$sql = "UPDATE city set Name = '$nom', CountryCode = '$cod', District = '$edo', Population = $pob WHERE ID = $id";
		$actualizar = $this->db->query($sql);
	}

	public function deleteCity($id){
		$sql = "DELETE from city WHERE ID = $id";
		$borrar = $this->db->query($sql);
	}

	public function getUser($user, $pass){
		$sql = "SELECT * from users WHERE usuario = '$user' AND contrasena='$pass'";
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else
			return false;
	}

}