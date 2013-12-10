<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_tipodocumentos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function getAll()
	{
		try {
			$sql = "SELECT * FROM tipodocumentos ";
			$query = $this->db->query($sql);
			return $query->result_array();

		} catch (Exception $e) {
			return array();
		}
	}

	public function getTipo($id_tipo)
	{
		try {
			$sql = "SELECT * FROM tipodocumentos WHERE id_tipodocumentos = $id_tipo ";
			$query = $this->db->query($sql);
			$tipo = $query->result_array();

			if (isset($tipo[0])) {
				return $tipo[0];
			} else {
				return false;
			}


		} catch (Exception $e) {
			return array();
		}
	}

	// public function getById($id_product)
	// {
	// 	try {
	// 		$sql = "SELECT * FROM productos P
	// 				JOIN categorias C
	// 					ON P.id_categorias=C.id_categorias
	// 				WHERE C.activo=1 AND P.id_productos = $id_product";
	// 		$query = $this->db->query($sql);

	// 		$product = $query->result_array();
	// 		if(isset($product[0])) {
	// 			return $product[0];
	// 		} else {
	// 			return false;
	// 		}

	// 	} catch (Exception $e) {
	// 		return array();
	// 	}
	// }

}

?>
