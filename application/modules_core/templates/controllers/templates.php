<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MY_Codeigniter
{


	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);


	}

	public function index()
	{
		echo 'templates';


	}

	public function heads()
	{
		die('pepe');
		$this->load->view('templates/heads', $data);


	}





}

?>
