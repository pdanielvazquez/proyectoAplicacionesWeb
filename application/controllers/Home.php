<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mi primer controlador en Codeigniter
 */
class Home extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Modelo_model');
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('home_view');
	}

	public function hola_mundo(){

		$titulo = 'Proyecto Web';
		$nombre = 'Juanito Pérez';
		$datos = array('title'=>$titulo, 'name'=>$nombre);
		$this->load->view('mensaje_view', $datos);
	}

	public function formulario(){
		$this->load->view('formulario_view');
	}

	public function recibe(){
		//$nombre = $_POST['nombre'];
		$nombre = $this->input->post('nombre');
		echo "El nombre del alumno es: ".$nombre;
	}

	public function ciudades(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}
		$ciudades = $this->Modelo_model->getCities();
		$datos = array('cities'=>$ciudades);
		$this->load->view('ciudades_view', $datos);
	}

	public function plantilla(){
		$this->load->view('plantilla_view');
	}

	public function landing(){
		$ciudades = $this->Modelo_model->getCities();
		$dato = array('titulo' => 'Ciudades', 'subtitulo'=>'registradas', 'cities'=>$ciudades);
		$this->load->view('encabezado', $dato);
		$this->load->view('navegacion');
		$this->load->view('cuerpo');
		$this->load->view('pie');
		$this->load->view('agregar_ciudad_jquery_view');
	}

	public function hombres(){
		$dato = array('titulo' => 'Hombres', 'subtitulo'=>'productos');
		$this->load->view('encabezado', $dato);
		$this->load->view('navegacion');
		$this->load->view('hombres_body');
		$this->load->view('pie');
	}

	public function nueva_ciudad(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}
		$paises = $this->Modelo_model->getCountries();
		$datos = array('countries' => $paises);
		$this->load->view('nueva_ciudad_view', $datos);
	}

	public function guardar_ciudad(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}

		$config['upload_path'] 	=	'./uploads/ciudades';
		$config['allowed_types']=	'png|jpg|gif|bmp|jpeg';
		//$config['allowed_types']=	"*";
		$config['max_size'] 	= 	1024;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_error());
			echo $error;
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];
			$nombre = $this->input->post('ciudad');
			$codigo = $this->input->post('pais');
			$estado = $this->input->post('estado');
			$poblacion = $this->input->post('poblacion');
			$this->Modelo_model->setCity($nombre, $codigo, $estado, $poblacion, $filename);
			redirect('Home/nueva_ciudad');
		}

	}

	public function editar_ciudad(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}
		$edicion = $this->uri->segment(4);
		$id = $this->uri->segment(3);
		$ciudad = $this->Modelo_model->getCity($id);
		$paises = $this->Modelo_model->getCountries();
		$datos = array('countries' => $paises, 'ciudad'=>$ciudad, 'edicion'=>$edicion);
		$this->load->view('editar_ciudad_view', $datos);
	}

	public function guardar_edicion(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}
		$id = $this->input->post('id');
		$nombre = $this->input->post('ciudad');
		$codigo = $this->input->post('pais');
		$estado = $this->input->post('estado');
		$poblacion = $this->input->post('poblacion');
		$this->Modelo_model->updateCity($id, $nombre, $codigo, $estado, $poblacion);
		redirect('Home/editar_ciudad/'.$id.'/1');
	}

	public function eliminar_ciudad(){
		if (!isset($_SESSION['iduser'])) {
			redirect('Home/logout');
		}
		$id = $this->uri->segment(3);
		$this->Modelo_model->deleteCity($id);
		redirect('Home/ciudades');
	}

	public function login(){
		$this->load->view('login_view');
	}

	public function autenticar(){
		$usuario = $this->input->post('user');
		$pass = $this->input->post('password');
		$usuario = $this->Modelo_model->getUser($usuario, $pass);
		if ($usuario!=false) {
			$user = $usuario->row(0);
			$_SESSION['iduser'] = $user->id_usuario;
			redirect('Home/ciudades');
		}
		else{
			echo "Usuario no existe";
		}
	}

	public function logout(){
		session_destroy();
		redirect('Home/login');
	}

}