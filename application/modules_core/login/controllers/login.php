

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Codeigniter {


	public function __construct(){
		parent::__construct();

		$this->section = $this->router->fetch_class() . '.' . $this->router->fetch_method();

		$last_uri		= $this->uri->total_segments();
		$this->last_uri	= $this->uri->segment($last_uri);
		$this->last_last_uri	= $this->uri->segment($last_uri - 1);
		// DATA DE VISTAS
		// $this->data 					= array();
		// $this->data['configure_link']		= 'productos/configuracion';
		// $this->data['configure_link_title']	= 'Configuración de Productos';
		// $this->data['css_includes']		= array();
		// $this->data['js_includes']		= array();
		$this->css_includes				= array('frontend/css/login.css');
		$this->data['view_menu_izq']	= 'login/menu_izq';
		// $this->data['title_section']		= 'PRODUCTOS';
	}



	public function index() {
		try {

			$data 					= $this->data;
			$data['section'] 			= $this->section; // en donde estamos
			$error_message		= array();
			$data['error_message'] 	= $error_message;
			$data['form_action'] 	= site_url('login');

			if($this->input->post('email') && $this->input->post('pass'))
			{
				//$data['login_user'] 		= $this->login_user;
				$dataUsuario['email'] 	= $this->input->post('email');
				$dataUsuario['clave'] 	= $this->input->post('pass');
				$usuario 				= $this->action_usuarios->validate($dataUsuario);

				if(isset($usuario) && $usuario['id_usuario'] > 0)
				{ 	// Lo encontró en la base como user registrado.
					//$this->load->model('admin_usuarios/usuarios_model');
					//$usuario = $this->usuarios_model->get($usuario);
					fillSession($usuario,$this->session); // lo mete dentro de la session.
					// $admin 			= isAdmin($this->session);
					// if($admin) {
					// 	redirect('admin_usuarios'); 	// BACKEND
					// } else {
					// 	redirect('homepage'); 		// FRONTEND
					// }
					redirect('');

				}else {
					$data['error_login'] = true;
				}

				// $data['title'] = 'Ingreso al panel de control';
				// $data['form_register'] = base_url('login/register');
				// $data['form_forgot'] = base_url('login/forgot');
				// $data['form_validate'] = base_url('login/validate');


			}

			// MENSAJES DE VALIDACIONES
			$data['error_message']		= $error_message;

			// DATOS DE VISTAS
			$data['id_menu_left'] 	= 'menu_login';
			$data['title']				= 'Control Stock';
			$data['id_content']		= 'login';
			$data['view_template']	= 'login/login';
			$data['title_section']		= 'LOGUEARSE';
			$data['show_list']		= false;
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

	public function salir()
	{
		$this->session->sess_destroy();
		redirect();
	}








}
?>
