<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_productos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function getAll()
	{
		try {
			$sql = "SELECT * FROM productos P
					JOIN categorias C
					ON P.id_categorias=C.id_categorias WHERE C.activo=1";
			$query = $this->db->query($sql);
			return $query->result_array();

		} catch (Exception $e) {
			return array();
		}
	}

	public function getById($id_product)
	{
		try {
			$sql = "SELECT * FROM productos P
					JOIN categorias C
						ON P.id_categorias=C.id_categorias
					WHERE C.activo=1 AND P.id_productos = $id_product";
			$query = $this->db->query($sql);

			$product = $query->result_array();

			if (isset($product[0])) {
				$product 			= $product[0];
				// $product['codigo'] 	= $this->action_productos->removeCodeGuion($product['codigo']);
			} else {
				$product = false;
			}

			return $product;

		} catch (Exception $e) {
			return array();
		}
	}

	public function getByCategory($id_category)
	{
		try {
			$sql 		= "SELECT * FROM productos P
							WHERE P.id_categorias = $id_category";
			$query 		= $this->db->query($sql);
			$products 	= $query->result_array();

			if (!isset($products[0])) {
				$products = false;
			}

			return $products;

		} catch (Exception $e) {
			return array();
		}
	}

	public function getByCodigo($code)
	{
		try {
			$sql 		= "SELECT * FROM productos P
							WHERE P.codigo = '$code' ";
			$query 		= $this->db->query($sql);
			$products 	= $query->result_array();

			if (!isset($products[0])) {
				$products = false;
			}

			return $products;

		} catch (Exception $e) {
			return array();
		}
	}

}

?>
