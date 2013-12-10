<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_stockactual extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function getAll()
	{
		try {
			$sql = "SELECT *
					FROM stock_actual SA
					INNER JOIN productos P
						ON SA.id_productos=P.id_productos
					WHERE SA.activo = 1
					";
			$query = $this->db->query($sql);
			return $query->result_array();

		} catch (Exception $e) {
			return array();
		}
	}


}

?>
