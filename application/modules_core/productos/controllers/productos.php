<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends MY_Codeigniter {


	public function __construct()
	{
		parent::__construct();

		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		$last_uri		= $this->uri->total_segments();
		$this->last_uri	= $this->uri->segment($last_uri);
		$this->last_last_uri	= $this->uri->segment($last_uri - 1);
		// DATA DE VISTAS
		// $this->data 					= array();
		$this->data['configure_link']		= 'productos/configuracion';
		$this->data['configure_link_title']	= 'Configuración de Productos';
		$this->data['css_includes']		= array();
		$this->data['js_includes']		= array();
		$this->css_includes				= array('frontend/css/productos.css');
		$this->data['view_menu_izq']	= 'productos/menu_izq';
		$this->data['title_section']		= 'PRODUCTOS';

		if (!isLogged($this->session)) {
			redirect('login');
		}
	}



	public function index()
	{
		try {

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	// AGREGAR UN PRODUCTO
	public function add()
	{
		try {

			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;
			$data['form_action'] 	= site_url('productos/add/');
			$data['categorys'] 		= $this->get_categorias->getAll();



			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ 		// START
				$product = $this->getDataEmpty();

			}else{ // GUARDAR, por post.
				$product = $this->getData();

				$error_message = $this->action_productos->validateAdd($product);

				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$insert_product = $this->action_productos->insert($product);
					if($insert_product) {
						$data['message_notice'] = 'Producto insertado con éxito';
					} else {
						$data['message_error'] = 'No pudo ser insertado el producto en la Base de Datos';
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





	// LISTAR LOSPRODUCTOS
	// $page => 'page/'   $number_page -> numero de primer fila que muestra del pagindor
	public function listar( $page = null, $number_page = null )
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;
			//$data['form_filter_action'] 	= site_url('productos/listar');

			$filter 		= array();
			$per_page 	= $this->config->item('pag_productos');


			if ($this->uri->segment(3) == 'cat' && $this->uri->segment(4) > 0)
			{ 	// FILTRADO
				$filter['category_filter'] 	= true;
				$filter['category_id'] 		= $this->uri->segment(4);
				$data['filter_category']	= $this->uri->segment(4);
				$base 					= 'http://sumi_cs/productos/listar/cat/' .$filter['category_id'] . '/page';
				$total_rows 			= $this->action_productos->countAllByCategory($filter['category_id']);
				$uri_segment 			= 6;
			}

			else
			{ // SIN FILTROS
				$filter['category_filter'] 	= false;
				$filter['category_id'] 		= 0;
				$data['filter_category']	= 0;
				$base 					= 'http://sumi_cs/productos/listar/page';
				$total_rows 			= $this->action_productos->countAll();
				$uri_segment 			= 4;

			}
			// PARA EL PAGINADOR
			if($this->last_last_uri == 'page') {
				$filter['limit'] = 'LIMIT ' . $this->last_uri . ', ' . ( $per_page );
			} else {
				$filter['limit'] = 'LIMIT 0, ' . ( $per_page );
			}


			// PAGINADOR  TODO: PONER EN UN ARCHIVO DE CONFIGURACIÓN
			$this->load->library('pagination');
			$config['base_url'] 		= $base;
			$config['total_rows'] 	= $total_rows;
			$config['per_page'] 		= $per_page;
			$config["uri_segment"] 	= $uri_segment;
			$config['num_links'] 		= 10;
			$config['full_tag_open'] 	= '<ul class="pagination">';
			$config['full_tag_close'] 	= '</ul>';
			$config['first_link'] 		= 'Primera';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] 		= 'Ultima';
			$config['last_tag_open'] 	= '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] 		= '>>';
			$config['next_tag_open']= '<li>';
			$config['next_tag_close']= '</li>';
			$config['prev_link'] 		= '<<';
			$config['prev_tag_open']= '<li>';
			$config['prev_tag_close']= '</li>';
			$config['cur_tag_open'] 	= '<li class="active"><a href="">';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open']= '<li>';
			$config['num_tag_close']= '</li>';
			$this->pagination->initialize($config);
			$data['paginador'] = $this->pagination->create_links();




			// CATEGORIAS
			$categorys 			= $this->get_categorias->getAll();
			$data['categorys'] 	= $categorys;


			// PRODUCTOS
			$products 			= $this->repo_productos->getProductos( $filter );
			$data['products']	= $products;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'listar_productos';
			$data['view_template']	= 'productos/listar';
			$data['show_add']		= true;
			$data['css_includes']	= $this->css_includes;
			$data['js_includes']		= array('frontend/js/del_product.js', '/frontend/js/product_filter_categorys.js');
			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}

	// VER EL PRODUCTO
	public function ver($id_product)
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos


			$error_message		= array();
			$data['error_message'] 	= $error_message;


			$product 				= $this->get_productos->getById($id_product);
			$data['product']			= $product;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock :: Ver Producto';
			$data['id_content']		= 'productos';
			$data['view_template']	= 'productos/ver';
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

	// EDITAR EL PRODUCTO
	public function editar($id_product)
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

	// CONFIGURACION :: MENU PRINCIPAL
	public function configuracion()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos_configuracion';
			$data['view_template']	= 'productos/config';
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

	// CONFIGURACION :: LISTAR CATEGORIAS
	public function confListarCategorias()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;


			$data['categorias']		= $this->get_categorias->getAll();


			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos_configuracion';
			$data['view_template']	= 'productos/config_listado_categorias';
			$data['css_includes']	= $this->css_includes;
			$data['js_includes']		= array('frontend/js/del_category.js');
			$data['show_add']		= true;
			$data['show_list']		= true;
			// VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}



	// AGREGAR UNA CATEGORIA
	public function add_categoria()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;

			$data['form_action'] 	= site_url('productos/add_categoria/');;




			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ // START
				$categoria = $this->getDataEmptyForCategory();

			}else{ // GUARDAR, por post.
				$categoria = $this->getDataForCategory();
				$error_message = $this->action_categorias->validateAdd($categoria);
				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$insert_categoria = $this->action_categorias->insert($categoria);
					if($insert_categoria) {
						$data['message_notice'] = 'Categoria insertada con éxito';
					} else {
						$data['message_error'] = 'No pudo ser insertada la categoría en la Base de Datos';
					}
					$categoria = $this->getDataEmptyForCategory();
				}
			}

			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;
			$data['categoria']			= $categoria;

			// DATOS DE VISTAS
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos_configuracion';
			$data['id_menu_left'] 	= 'menu_productos';
			$data['box_title']		= 'ALTA DE LA CATEGORÍA';
			$data['view_template']	= 'productos/config_add_edit_categorias';
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

	// AGREGAR UNA CATEGORIA
	public function config_paginador()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			// $error_message		= array();
			// $data['error_message'] 	= $error_message;

			$data['form_action'] 	= site_url('productos/config_paginador/');;

			if ($this->input->server('REQUEST_METHOD') == 'POST')
			{
				$cant_items = (int)$this->input->post('cant_items');

				$content = '<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
							$config["pag_productos"] = ' . $cant_items . ';
							?>';
				file_put_contents("application/config/pag_productos.php", $content);

				$data['cant_items']	= $cant_items;
			} else {
				$cant_items 		= (int)$this->config->item('pag_productos');
				$data['cant_items'] 	= $cant_items;
			}
			// // MENSAJES DE VALIDACIONES
			// $data['error_message']		= $error_message;
			// $data['categoria']			= $categoria;

			// DATOS DE VISTAS
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos_configuracion';
			$data['id_menu_left'] 	= 'menu_productos';
			$data['box_title']		= 'PAGINADOR';
			$data['view_template']	= 'productos/config_paginador';
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


	public function editar_categoria($id_category)
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();

			$data['form_action'] 	= site_url('productos/editar_categoria/' . $id_category);;



			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ // START
				$category = $this->get_categorias->getById($id_category);
				if ($category == false) {
					// ERROR NO PUDO AGARRAR EL PRODUCTO
				}

			}else{ // POST
				// CATEGORIAS
				$category 					= $this->getDataForCategory();
				$category['id_categorias']	= $id_category;
				$error_message 			= $this->action_categorias->validateAddUpdated($category);

				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$update_category = $this->action_categorias->update($category);

					if($update_category) {
						$message = 'Categoria editada con éxito';
						$this->session->set_flashdata('flash_notice', $message);
						redirect('productos/confListarCategorias');
					} else {
						$message = 'La categoría no fue editada.';
						$this->session->set_flashdata('flash_error', $message);
						redirect('productos/confListarCategorias');
					}
					$category = $this->getDataEmpty();
				}
			}


			// CATEGORIA
			$data['categoria']				= $category;
			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;
			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_productos';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'productos_configuracion';
			$data['box_title']		= 'EDICIÓN DE LA CATEGORÍA';
			$data['view_template']	= 'productos/config_add_edit_categorias';
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['css_includes']	= $this->css_includes;
			$data['no_edit']			= true;
			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}



	protected function getDataEmpty()
	{
		$product = array();

		$product['codigo'] 			= '';
		$product['descripcion']		= '';
		$product['detalle'] 			= '';
		$product['observaciones'] 	= '';
		$product['id_categorias'] 	= $this->get_categorias->getAll();

		return $product;
	}

	protected function getDataEmptyForCategory()
	{
		$category = array();

		$category['id_categorias'] 	= 0;
		$category['nombre']			= '';
		$category['codigo_abrev'] 	= '';
		$category['activo'] 			= 1;

		return $category;
	}



	protected function getData()
	{
		$product = array();
		// CODIGO
		if($this->input->get_post('codigo')) {
			$product['codigo'] = trim($this->input->get_post('codigo'));
		} else {
			$product['codigo'] = '';
		}
		// DESCRIPCION
		if($this->input->get_post('descripcion')) {
			$product['descripcion'] = trim($this->input->get_post('descripcion'));
		} else {
			$product['descripcion'] = '';
		}
		// DETALLE
		if($this->input->get_post('detalle')) {
			$product['detalle'] = trim($this->input->get_post('detalle'));
		} else {
			$product['detalle'] = '';
		}
		// OBSERVACIONES
		if($this->input->get_post('observaciones')) {
			$product['observaciones'] = trim($this->input->get_post('observaciones'));
		}else {
			$product['observaciones'] = '';
		}
		// ID_CATEGORIAS
		if($this->input->post('id_categorias')) {
			$product['id_categorias']= $this->input->post('id_categorias');
		} else {
			$product['id_categorias'] = NULL;
		}

		return $product;
	}

	protected function getDataForCategory()
	{
		$category = array();

		if($this->input->get_post('nombre')) {
			$category['nombre'] = trim($this->input->get_post('nombre'));
		} else {
			$category['nombre'] = '';
		}

		if($this->input->get_post('codigo_abrev')) {
			$category['codigo_abrev'] = trim($this->input->get_post('codigo_abrev'));
		} else {
			$category['codigo_abrev'] = '';
		}

		$category['activo'] = 1;

		return $category;
	}




}
?>
