<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remitos extends MY_Codeigniter
{

	public function __construct(){
		parent::__construct();
		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		// $this->css_includes				= array('frontend/css/remitos.css');
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


	/**
	 * Agregar un remito
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	16 de diciembre del 2013
	 *
	 * @return      void
	 **/
	public function agregar()
	{
		try {

			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;
			$data['form_action'] 	= site_url('remitos/agregar/');
			// $data['categorys'] 		= $this->get_categorias->getAll();



			if ( $this->input->server('REQUEST_METHOD') == 'POST' )
			{ 	// POST



				// Estoy agregando items al remito
				if (isset($_POST['agregar']))
				{
					$item = $this->getDataItems();

				}

				if (isset($_POST['remito_header']))
				{
					$remito_header = $this->getDataRemitoHeader();

				}

			}

			// debe levantar todos los productos disponibles, que ya estan ingresados al stock. . . .

			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;


			$productos 			= $this->get_productos->getAll();
			$data['productos'] 	= $productos;
			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_remitos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'remitos';
			$data['view_template']	= 'remitos/add';
			$data['show_list']		= true;
			$data['show_add']		= true;
			$data['configure_link']	= true;
			$data['configure_link_title']= 'Configuraciones Remitos';
			$data['css_includes']	= array('frontend/css/remitos.css', 'frontend/datepicker/jquery-ui.css',
											'../../assets/chosen/chosen.css');
			$data['js_includes']		= array('frontend/datepicker/datepicker.spanish.js',
											'frontend/datepicker/jquery-ui.js',
											'../../assets/chosen/chosen.jquery.js');
			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * Nos dá los POST de la cabecera del remito.
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	18 de diciembre del 2013
	 *
	 * @return      Array
	 **/
	private function getDataRemitoHeader()
	{
		$remito = Array();

		if ($this->input->post('fecha')) {
			$remito['fecha'] = $this->input->post('fecha');
		} else {
			$remito['fecha'] = '';
		}
		if ($this->input->post('destino')) {
			$remito['destino'] = $this->input->post('destino');
		} else {
			$remito['destino'] = '';
		}
		if ($this->input->post('observaciones')) {
			$remito['observaciones'] = $this->input->post('observaciones');
		} else {
			$remito['observaciones'] = '';
		}

		return $remito;
	}



	/**
	 * Nos dá los POST del item cargado del remito
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	18 de diciembre del 2013
	 *
	 * @return      Array
	 **/
	private function getDataItems()
	{
		$item = Array();

		if ($this->input->post('cantidad')) {
			$item['cantidad'] = $this->input->post('cantidad');
		} else {
			$item['cantidad'] = 0;
		}
		if ($this->input->post('producto')) {
			$item['producto'] = $this->input->post('producto');
		} else {
			$item['producto'] = 0;
		}

		return $item;
	}



}
?>
