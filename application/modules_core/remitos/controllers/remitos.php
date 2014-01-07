<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remitos extends MY_Codeigniter
{

	public function __construct(){
		parent::__construct();
		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();
		$this->load->model('remitos/repo_remitos'); // Repositorio del modelo de Remito
		$this->load->model('remitos/get_remitos'); 	// Consultas simples, tipo getNombre();
		$this->load->library('session');
		$this->load->helper('date');
		// $this->css_includes				= array('frontend/css/remitos.css');
		$this->data['view_menu_izq']	= 'productos/menu_izq';
		$this->data['title_section']		= 'REMITOS';
		$this->data['js_includes']		= array();
		if (!isLogged($this->session)) {
			redirect('login');
		}
	}

	public function __destruct()
	{
		echo 'destructor';
		die();
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

			$remito_header = $this->getDataRemitoHeader();

			if ( $this->input->server('REQUEST_METHOD') == 'POST' )
			{ 	// POST

				// Datos de cabecera del remito.
				if (isset($_POST['remito_header']))
				{
					// Valido la cabecera del remito.
					$validate_header = $this->repo_remitos->validate($remito_header);
					if (count($validate_header) > 0) {
						$error_message = $validate_header;
					} else {

						// No hay errores en la cabecera.
						if (!$this->session->userdata('id_remitos')) {
							// Es la primera vez que carga la cabecera del remito.
							$insert_header 		= $this->repo_remitos->insertHeader($remito_header);
							if ($insert_header > 0) {
								$this->session->set_userdata('id_remitos', $insert_header);
							}
						} else {
							// Está modificando la cabecera del remito.
							$id_remitos 		= $this->session->userdata('id_remitos');
							$update_header 	= $this->repo_remitos->updateHeader($remito_header, $id_remitos);
							$remito_header = $this->getDataRemitoHeader();
						}
					}
				}


				// Estoy agregando items al remito
				if (isset($_POST['agregar']))
				{



					$item = $this->getDataItems();

					if ($this->session->userdata('id_remitos'))
					{
						$id_remitos 	= $this->session->userdata('id_remitos');
						$insert_item 	= $this->repo_remitos->insertItem($item, $id_remitos);
						if ($insert_item == 0) {
							$error_message['noinserto'] = "No pudo insertar el item seleccionado";
						}

					} else {
						$error_message['cabecer'] = "Primero debe cargar los datos de cabecera.";
					}

				}




			}

			if ($this->session->userdata('id_remitos')) {
				$id_remitos = $this->session->userdata('id_remitos');
				$items = $this->repo_remitos->getAllItems($id_remitos);
			} else {
				$items = array();
			}


			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;


			$productos 				= $this->get_productos->getAll();
			$data['productos'] 		= $productos;
			$data['remito_header']	= $remito_header;
			$data['items']			= $items;
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
											'frontend/js/move_header_remito.js',
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
	 * También debe consultar si ya existe una variable de session id_remito
	 * Si es así debe traer los datos para volverlos a imprimir en la vista
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

		if($this->session->userdata('id_remitos') && !isset($_POST['remito_header'])) {
			$id_remitos = $this->session->userdata('id_remitos');
			$remito 	= $this->get_remitos->getById($id_remitos);
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
