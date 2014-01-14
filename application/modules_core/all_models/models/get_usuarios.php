<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_entradas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function getUser($id_product)
	{
		try {
			$sql = "SELECT * FROM entradas E
					WHERE E.id_productos = $id_product";
			$query = $this->db->query($sql);

			$entradas = $query->result_array();

			if (isset($entradas[0])) {
				$entradas 			= $entradas[0];
				// $product['codigo'] 	= $this->action_productos->removeCodeGuion($product['codigo']);
			} else {
				$entradas = false;
			}

			return $entradas;

		} catch (Exception $e) {
			return array();
		}
	}





}

?>
