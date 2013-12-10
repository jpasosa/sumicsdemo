<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entrada_stock extends MY_Codeigniter {


	public function __construct(){
		parent::__construct();

		if (!isLogged($this->session)) {
			redirect('login');
		}

		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		$last_uri		= $this->uri->total_segments();
		$this->last_uri	= $this->uri->segment($last_uri);


		// DATOS DE VISTAS, EN TODO ENTRADA DE STOCK
		// $this->data 					= array();
		$this->data['view_menu_izq']	= 'entrada_stock/menu_izq';
		$this->css_includes				= array('frontend/css/entrada_stock.css');
		$this->data['title_section']		= 'INGRESOS AL STOCK';
		$this->data['id_menu_left'] 		= 'menu_entradas';
		$this->data['title']				= 'CS :: Entradas';
		$this->data['id_content']		= 'entrada_stock';

	}



	public function index() {
		try {

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}


	public function nueva_entrada($params = null)
	{
		try {

			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$data['id_menu_left'] 	= 'menu_entradas';

			$error_message		= array();
			$data['error_message'] 	= $error_message;
			$data['view_template']	= 'entrada_stock/agregar_productos';



			// GROCERY CRUD
			$this->load->library('grocery_CRUD');
			$crud = new grocery_CRUD();

			// LLAMO DESPUES DE HACER EL INSERT EN ENTRADAS
			$crud->callback_after_insert(array($this, 'insert_trans_entradas'));

			// TABLAS
			$crud->set_subject('Entradas al Stock');
			$crud->set_theme('flexigrid');
			$crud->set_table('entradas');
			$fields = array('fecha_created', 'id_productos','id_tipodocumento','nro_tipodocumento','precio', 'cantidad', 'observaciones');
			$crud->columns($fields);
			// RELACIONES
			if ($this->last_uri == 'add') {
				$crud->set_relation('id_productos', 'productos', '{descripcion} :: {detalle} :: {codigo}');
			} else {
				$crud->set_relation('id_productos', 'productos', '{descripcion} - {detalle}');
			}
			$crud->set_relation('id_tipodocumento', 'tipodocumentos', 'nombre');
			// ADD
			$crud->add_fields($fields);
    			// EDIT
    			$crud->edit_fields($fields);
    			$crud->unset_edit();
    			$crud->unset_delete();
			$crud->display_as('fecha_created','Fecha')
					->display_as('id_productos','Producto')
	             		->display_as('id_tipodocumento','Tipo de Documento')
					->display_as('nro_tipodocumento','Número del documento')
					->display_as('precio','Precio')
					->display_as('cantidad','Cantidad')
					->display_as('observaciones','Observaciones');
			$crud->field_type( 'observaciones' , 'text' );
			$crud->required_fields('fecha_created', 'id_productos','id_tipodocumento','nro_tipodocumento','precio', 'cantidad');
			$crud->unset_texteditor('observaciones');
			$crud->unset_export();
			$crud->unset_print();







			// CONFIGURACIONES
			$crud->unset_jquery();
        		$data['output'] 		= $crud->render()->output;
        		$data['css_grocery'] = $crud->render()->css_files;
			$data['js_grocery']	= $crud->render()->js_files;

				// $this->_example_output($output);

        		// $this->data = array(
          //                               'h1' => 'Items',
          //                               'h2' => 'Administrar',
          //                               'contenido' => 'crud/index',
          //                               'active' => 'items',
          //                               'output' => $crud->render()->output,
          //                               'css_files' => $crud->render()->css_files,
          //                               'js_files' => $crud->render()->js_files,
          //                               'tabs' => $tabs,
          //                                );


			// DATOS DE VISTAS
			if ($this->last_uri == 'add') { // ESTÁ AGREGANDO UN PRODUCTO AL STOCK
				$data['show_add']		= false;
				$data['show_list'] 		= true;
			} else { // LISTANDO LAS ENTRADAS DEL STOCK
				$data['show_add']		= true;
				$data['show_list'] 		= false;
			}
			$data['configure_link'] 	= true;
			$data['css_includes']	= $this->css_includes;
			// VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			//$this->_example_output($output);
			$this->load->view('templates/footer', $data);





		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	// CUANDO TERMINA DE INSERTAR EN ENTRADAS VIENE ACÁ
	public function insert_trans_entradas($nueva_entrada, $id_entrada)
	{
		$id_trans 			= $this->action_trans->insertEntradas();
		$update_entradas 	= $this->action_entradas->update($id_entrada, $id_trans);
		$insert_stock_actual= $this->action_stockactual->insert($nueva_entrada, $id_trans);

	    return true;
	}


	// CONFIGURACION :: MENU PRINCIPAL
	public function config()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;

			// DATOS DE VISTAS


			$data['view_template']	= 'entrada_stock/config';
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['configure_link']	= true;
			$data['css_includes']	= $this->css_includes;
			$data['id_content']		= 'entradas_configuracion';
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
	public function config_tipo_alta()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;

			$data['form_action'] 	= site_url('entrada_stock/config_tipo_alta/');;

			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ // START
				$tipo = array('nombre' => '');

			}else{ // GUARDAR, por post.
				// NOMBRE DEL TIPO DE DOCUMENTO
				if($this->input->get_post('nombre')) {
					$tipo['nombre'] = trim($this->input->get_post('nombre'));
				} else {
					$tipo['nombre'] = '';
				}

				$error_message = $this->action_tipodocumentos->validateAdd($tipo);
				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$insert_tipo = $this->action_tipodocumentos->insert($tipo);
					if($insert_tipo) {
						$data['message_notice'] = 'Tipo de Documento insertada con éxito';
					} else {
						$data['message_error'] = 'No pudo ser insertado el Tipo de Documento en la Base de Datos';
					}
					//$categoria = $this->getDataEmptyForCategory();
				}
			}

			// MENSAJES DE VALIDACIONES
			$data['error_message']	= $error_message;
			$data['tipo']				= $tipo;

			// DATOS DE VISTAS
			$data['title']				= 'Control Stock';
			$data['id_menu_left'] 	= 'menu_entradas';
			$data['box_title']		= 'ALTA DEL TIPO DE DOCUMENTO';
			$data['view_template']	= 'entrada_stock/config_add_edit_tipodocumentos';
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['configure_link']	= true;
			$data['css_includes']	= $this->css_includes;
			$data['id_content']		= 'entradas_configuracion';
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
	public function config_tipo_editar($id_tipo)
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;



			if($this->input->server('REQUEST_METHOD') == 'GET')
			{ // START
				$tipo = $this->get_tipodocumentos->getTipo($id_tipo);

			}else{ // POST
				// NOMBRE DEL TIPO DE DOCUMENTO

				if($this->input->get_post('nombre')) {
					$tipo['nombre'] = trim($this->input->get_post('nombre'));
				} else {
					$tipo['nombre'] = '';
				}
				if($this->input->get_post('id_tipodocumentos')) {
					$tipo['id_tipodocumentos'] = trim($this->input->get_post('id_tipodocumentos'));
				}

				$error_message = $this->action_tipodocumentos->validateAdd($tipo);
				if(!$error_message)
				{  	// PASO LA VALIDACIÓN
					$update_tipo = $this->action_tipodocumentos->update($tipo);
					if($update_tipo) {
						$message = 'Tipo de Documento editado con éxito';
						$this->session->set_flashdata('flash_notice', $message);
						redirect('entrada_stock/config_listado_documentos');
					} else {
						$message = 'No pudo ser editado el Tipo de Documento en la Base de Datos';
						$this->session->set_flashdata('flash_error', $message);
						redirect('entrada_stock/config_listado_documentos');
					}
				}
			}

			// MENSAJES DE VALIDACIONES
			$data['error_message']	= $error_message;
			$data['tipo']				= $tipo;





			// DATOS DE VISTAS
			$data['form_action'] 	= site_url('entrada_stock/config_tipo_editar/' . $tipo['id_tipodocumentos']);
			$data['title']				= 'Control Stock';
			$data['id_menu_left'] 	= 'menu_entradas';
			$data['box_title']		= 'ALTA DEL TIPO DE DOCUMENTO';
			$data['view_template']	= 'entrada_stock/config_add_edit_tipodocumentos';
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['configure_link']	= true;
			$data['css_includes']	= $this->css_includes;
			$data['id_content']		= 'entradas_configuracion';
			// LEVANTO VISTAS
			$this->load->view('templates/heads', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/content', $data);
			$this->load->view('templates/footer', $data);

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}


	// LISTADO DE TIPOS DE DOCUMENTOS
	public function config_listado_documentos()
	{
		try {
			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos

			$error_message		= array();
			$data['error_message'] 	= $error_message;

			$tipos 				= $this->get_tipodocumentos->getAll();
			$data['tipos']		= $tipos;

			// DATOS DE VISTAS
			$data['id_content']		= 'entradas_configuracion';
			$data['id_menu_left'] 	= 'menu_entradas';
			$data['title']				= 'Control Stock';
			$data['view_template']	= 'entrada_stock/config_listado_documentos';
			$data['css_includes']	= $this->css_includes;
			$data['js_includes']		= array('frontend/js/del_tipo.js');
			$data['show_add']		= true;
			$data['show_list']		= true;
			$data['configure_link']	= true;
			// VISTAS
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
