<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_remitos extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	/**
	 * Agarra el registro de la tabla remitos
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	3 de enero del 2014
	 *
	 * @return      Array()
	 **/
	public function getById($id_remitos)
	{

		try {
			$query 	= $this->db->get_where('remitos', array('id_remitos' => $id_remitos));
			$result 	= $query->result_array();
			if ($this->db->affected_rows()) {
				$result[0]['fecha'] = mysqlToEs($result[0]['fecha']);

				return $result[0];
			} else {
				return NULL;
			}

		} catch (Exception $e) {
			return NULL;
		}



	}





}

?>
