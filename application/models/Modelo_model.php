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
}