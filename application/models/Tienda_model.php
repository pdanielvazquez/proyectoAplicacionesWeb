<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getProducto($id=0){
		if ($id>0) {
			$sql = "SELECT * from `productos` WHERE id_producto = $id";
		}else{
			$sql = "SELECT * from `productos`";
		}
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}else{
			return false;
		}
	}

	public function setProducto($nom, $cat, $mar, $pre, $des, $img){
		$sql = "INSERT into productos values ('', '$nom', '$cat', '$mar', $pre, '$des', '".date("Y-m-d H:i:s")."', 1, '$img')";
		//echo $sql;
		$inserta = $this->db->query($sql);
	}

	public function updateProducto($id, $nom, $cat, $mar, $pre, $des, $img){
		$sql = "UPDATE productos set `nombre`='$nom', `categoria`='$cat', `marca`='$mar', `precio`=$pre, `descripcion`='$des', `imagen`='$img' WHERE `id_producto`=$id";
		$actualizar = $this->db->query($sql);
	}

	public function deleteProducto($id){
		$sql = "DELETE from productos WHERE `id_producto` = $id";
		$borrar = $this->db->query($sql);
	}

	public function getUsuario($id, $correo, $contra){
		if ($id!='') {
			$sql = "SELECT * from usuarios where id_usuario = $id";
		}
		else{
			$sql = "SELECT * from usuarios WHERE email = '$correo' AND f_nacimiento = '$contra'";
		}
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else{
			return false;
		}
	}

	public function getAdmin($iduser){
		$sql = "SELECT * from administadores where id_usuario = $iduser";
		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function getExistencia($idp=0, $talla=0){
		$where = '';
		if ($talla>0){
			$where = " WHERE talla=$talla ";
		}

		if ($idp>0){
			if ($idp=='') {
				$idp = " WHERE id_producto=$idp ";
			}
			else{
				$idp .= " AND id_producto=$idp ";	
			}
		}

		$sql = "SELECT * from existencias $where";

		$resultado = $this->db->query($sql);
		if ($resultado->num_rows()>0) {
			return $resultado;
		}
		else{
			return false;
		}
	}

}