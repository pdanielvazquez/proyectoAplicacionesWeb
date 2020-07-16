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
	}

	public function hombres(){
		$dato = array('titulo' => 'Hombres', 'subtitulo'=>'productos');
		$this->load->view('encabezado', $dato);
		$this->load->view('navegacion');
		$this->load->view('hombres_body');
		$this->load->view('pie');
	}

}