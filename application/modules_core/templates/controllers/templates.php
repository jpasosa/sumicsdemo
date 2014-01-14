<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MY_Codeigniter
{


	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);

		// Destruyo session de encabezado de los remitos si es que existe.
		dieSessionRemito($this->session);


	}

	public function index()
	{
		echo 'templates';


	}

	public function heads()
	{
		$this->load->view('templates/heads', $data);


	}





}

?>
