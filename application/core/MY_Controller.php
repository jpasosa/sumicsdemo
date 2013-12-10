<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class MY_Codeigniter extends MX_Controller {


	public function __construct(){


		parent::__construct();

		$data = array();


		// $this->session->sess_destroy();

		if (!isLogged($this->session)) {
			$data['login'] 	= false;
		} else {
			$data['login']	= true;
		}



		$this->data = $data;

	}






	public function index() {

	}






}
?>
