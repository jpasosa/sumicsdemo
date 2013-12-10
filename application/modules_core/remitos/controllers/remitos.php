<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remitos extends MY_Codeigniter
{

	public function __construct(){
		parent::__construct();
		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		$this->css_includes				= array('frontend/css/remitos.css');
		$this->data['view_menu_izq']	= 'productos/menu_izq';
		$this->data['title_section']		= 'REMITOS';
		$this->data['js_includes']		= array();
	}

	public function index()
	{
		try {

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function listar()
	{
		try {


		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}


	// AGREGAR UN PRODUCTO
	public function agregar()
	{
		try {

			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;
			$data['form_action'] 	= site_url('remitos/agregar/');
			// $data['categorys'] 		= $this->get_categorias->getAll();



			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ 		// START
				// $product = $this->getDataEmpty();

			}else if ( $this->input->server('REQUEST_METHOD') == 'POST' )
			{ // POST
				echo 'vino por post';
				die();

			}

			// debe levantar todos los productos disponibles, que ya estan ingresados al stock. . . .

			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_remitos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'remitos';
			$data['view_template']	= 'remitos/add';
			$data['show_list']		= true;
			$data['show_add']		= true;
			$data['configure_link']	= true;
			$data['configure_link_title']= 'Configuraciones Remitos';
			//$data['css_includes']	= $this->css_includes;
			$data['css_includes']	= array('frontend/datepicker/jquery-ui.css');

			$data['js_includes']		= array('frontend/datepicker/datepicker.spanish.js',
											'frontend/datepicker/jquery-ui.js');


			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}



}
?>
