<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_actual extends MY_Codeigniter {


	public function __construct(){
		parent::__construct();

		if (!isLogged($this->session)) {
			redirect('login');
		}

		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		// DATA DE VISTAS
		// $this->data 					= array();
		$this->data['css_includes']		= array();
		$this->data['js_includes']		= array();
		$this->css_includes				= array('frontend/css/stock_actual.css');
		$this->data['view_menu_izq']	= 'stock_actual/menu_izq';
		$this->data['title_section']		= 'STOCK ACTUAL';
	}



	public function index() {
		try {

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	// LISTAR LOSPRODUCTOS
	public function listar()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;

			// PRODUCTOS EN STOCK
			$stock_actual 			= $this->get_stockactual->getAll();
			$data['stock_actual']	= $stock_actual;


			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_stockactual';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'listar_stock';
			$data['view_template']	= 'stock_actual/lista_stock';
			$data['show_in']		= true;
			$data['show_out']		= true;
			$data['css_includes']	= $this->css_includes;
			// $data['js_includes']		= array('frontend/js/del_product.js');
			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}

	// EDITAR EL PRODUCTO
	public function ver_editar($id_product)
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['form_action'] 	= site_url('productos/editar/' . $id_product);;
			$data['categorys'] 		= $this->get_categorias->getAll();


			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ // START
				$product = $this->get_productos->getById($id_product);
				if ($product == false) {
					// ERROR NO PUDO AGARRAR EL PRODUCTO
				}

			}else { // GUARDAR, por post.
				// PRODUCTOS
				$product 				= $this->getData();
				$product['id_productos']	= $id_product;

				$error_message = $this->action_productos->validateEdit($product);

				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$update_product = $this->action_productos->update($product);
					if($update_product) {
						$message = 'Producto editado con éxito';
						$this->session->set_flashdata('flash_notice', $message);
						redirect('productos/listar');
					} else {
						$data['message_error'] = 'No pudo ser editado el producto en la Base de Datos';
					}
					$product = $this->getDataEmpty();
				}
			}


			// PRODUCTO
			$data['product']				= $product;
			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos';
			$data['view_template']	= 'productos/add_edit';
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['css_includes']	= $this->css_includes;
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
