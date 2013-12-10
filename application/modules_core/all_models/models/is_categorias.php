<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Is_categorias extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}



	public function existCodAbrev($code)
	{

		try {
			$sql = "SELECT * FROM categorias C
					WHERE C.codigo_abrev = '$code' AND C.activo=1";
			$query = $this->db->query($sql);
			$resp = $query->result_array();

			if(count($resp) > 0) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			return array();
		}



	}



}

?>
