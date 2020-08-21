<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tienda_model');
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		$conta = 0;
		if (isset($_SESSION['productos'])) {
			$conta = count($_SESSION['productos']);
		}else{
			$_SESSION['productos'] = array();
		}

		if ($this->uri->segment(3)!=false) {
			$categoria = $this->uri->segment(3);
		}
		else
			$categoria = 'Mujeres';	

		$usuarios = false;
		if (!isset($_SESSION['id_user'])) {
			$usuarios = false;
		}
		else{
			$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		}
		$productos = $this->Tienda_model->getProducto();
		$data = array('productos'=>$productos, 'categoria'=>$categoria, 'usuarios'=>$usuarios, 'conta'=>$conta);
		$this->load->view('Tienda/catalogo_view', $data);
	}

	public function registro(){
		$this->load->view('Tienda/registro_view');
	}

	public function login(){
		$this->load->view('Tienda/login_view');
	}

	public function agregar(){
		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		$data = array('usuarios'=>$usuarios);
		$this->load->view('Tienda/agregar_view', $data);
	}

	public function registrados(){

		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		$productos = $this->Tienda_model->getProducto();
		$data = array('productos'=>$productos, 'usuarios'=>$usuarios);
		$this->load->view('Tienda/registrados_view', $data);
	}

	public function guardar_producto(){

		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		if ($_FILES['userfile']['name']!='') {

			$config['upload_path'] 	=	'./uploads/productos';
			$config['allowed_types']=	'png|jpg|gif|bmp|jpeg';
			$config['max_size'] 	= 	2048;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				$filename = $data['upload_data']['file_name'];
				
				$nombre = $this->input->post('nombre');
				$categoria = $this->input->post('categoria');
				$marca = $this->input->post('marca');
				$precio = $this->input->post('precio');
				$descripcion =$this->input->post('descripcion');
				$imagen = $this->input->post('userfile');

				$this->Tienda_model->setProducto($nombre, $categoria, $marca, $precio, $descripcion, $filename);
			}
		}
		else{

			$nombre = $this->input->post('nombre');
			$categoria = $this->input->post('categoria');
			$marca = $this->input->post('marca');
			$precio = $this->input->post('precio');
			$descripcion =$this->input->post('descripcion');
			$imagen = '700x400.png';

			$this->Tienda_model->setProducto($nombre, $categoria, $marca, $precio, $descripcion, $imagen);
		}

		redirect('Tienda/registrados');
	}

	public function editar(){

		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		$id_producto = $this->uri->segment(3);
		$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		$productos = $this->Tienda_model->getProducto($id_producto);
		$data = array('productos'=>$productos, 'usuarios'=>$usuarios);
		$this->load->view('Tienda/editar_view', $data);
	}

	public function actualizar_producto(){

		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		if ($_FILES['userfile']['name']!='') {

			$config['upload_path'] 	=	'./uploads/productos';
			$config['allowed_types']=	'png|jpg|gif|bmp|jpeg';
			$config['max_size'] 	= 	2048;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				$filename = $data['upload_data']['file_name'];
				
				$id_producto = $this->input->post('id');
				$nombre = $this->input->post('nombre');
				$categoria = $this->input->post('categoria');
				$marca = $this->input->post('marca');
				$precio = $this->input->post('precio');
				$descripcion =$this->input->post('descripcion');

				$this->Tienda_model->updateProducto($id_producto, $nombre, $categoria, $marca, $precio, $descripcion, $filename);
			}
		}
		else{
			$id_producto 	= $this->input->post('id');
			$nombre 		= $this->input->post('nombre');
			$categoria 		= $this->input->post('categoria');
			$marca 			= $this->input->post('marca');
			$precio 		= $this->input->post('precio');
			$descripcion 	= $this->input->post('descripcion');
			$imagen 		= $this->input->post('imagen');

			$this->Tienda_model->setProducto($nombre, $categoria, $marca, $precio, $descripcion, $imagen);
		}

		redirect('Tienda/registrados');

	}

	public function borrar(){
		if (!isset($_SESSION['id_admon'])) {
			redirect('Tienda/logout');
		}

		$id_producto = $this->uri->segment(3);
		$this->Tienda_model->deleteProducto($id_producto);
		redirect('Tienda/registrados');
	}

	public function verificar(){
		$usuario = $this->input->post('correo');
		$contras = $this->input->post('password');
		$users = $this->Tienda_model->getUsuario('', $usuario, $contras);
		if ($users!=false) {
			$user = $users->row(0);
			$admin = $this->Tienda_model->getAdmin($user->id_usuario);
			$_SESSION['id_user'] = $user->id_usuario;
			if ($admin!=false) {
				$_SESSION['id_admon'] = true;
				redirect ('Tienda/registrados');
			}
				redirect ('Tienda/index');
		}
		else{
			redirect ('Tienda/login');
		}
	}

	public function logout(){
		session_destroy();
		redirect('Tienda/index');
	}

	public function agregar_producto(){

		$conta = 0;
		if (isset($_SESSION['productos'])) {
			$conta = count($_SESSION['productos']);
		}

		$usuarios = false;
		if (!isset($_SESSION['id_user'])) {
			$usuarios = false;
		}
		else{
			$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		}

		$id_producto = $this->uri->segment(3);
		$productos = $this->Tienda_model->getProducto($id_producto);
		$existencias = $this->Tienda_model->getExistencia($id_producto, 0);
		$data = array('productos'=>$productos, 'usuarios'=>$usuarios, 'existencias'=>$existencias, 'conta'=>$conta);
		$this->load->view('Tienda/agregar_producto_view', $data);

	}

	public function agregar_bolsa(){

		$id_producto = $this->uri->segment(3);
		$talla = $this->input->post('talla');
		$cantidad = $this->input->post('cantidad');

		$existencias = $this->Tienda_model->getExistencia($id_producto, $talla);
		if ($existencias!=false) {
			$existencia = $existencias->row(0);
			if (array_key_exists($existencia->id_existencia, $_SESSION['productos'])) {
				$_SESSION['productos'][$existencia->id_existencia] += $cantidad;
			}
			else{
				$_SESSION['productos'][$existencia->id_existencia] = $cantidad;
			}
			echo "$id_producto, talla: $talla, cantidad: $cantidad";
			print_r($_SESSION['productos']);
		}

		redirect('Tienda/agregar_producto/'.$id_producto);

	}

	public function carrito(){

		$conta = 0;
		if (isset($_SESSION['productos'])) {
			$conta = count($_SESSION['productos']);
		}

		$usuarios = false;
		if (!isset($_SESSION['id_user'])) {
			$usuarios = false;
		}
		else{
			$usuarios = $this->Tienda_model->getUsuario($_SESSION['id_user'], '', '');
		}

		$id_producto = $this->uri->segment(3);
		$productos = $this->Tienda_model->getProducto();
		$existencias = $this->Tienda_model->getExistencia();
		$data = array('productos'=>$productos, 'usuarios'=>$usuarios, 'productos'=>$productos, 'existencias'=>$existencias, 'conta'=>$conta);
		$this->load->view('Tienda/carrito_view', $data);

	}

	public function confirmar(){
		echo "Aqui se debe agregar la confirmacion";
		echo "<br>Si la persona se ha logeado entonces se registra la venta del producto";
		echo "<br>Si la persona no esta logeada entonces se le pide logearse antes de poder comprar";
		echo "<br>Si la persona no esta registrada, no puede comprar";
		echo "<br><br><a href='index'>Regresar al catalogo</a>";
		echo "  <a href='logout'>Vaciar el carrito</a>";
	}

}
