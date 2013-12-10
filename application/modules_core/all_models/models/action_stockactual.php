<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_stockactual extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function insert($entrada, $id_trans)
	{
		$data = array('id_productos' 	=> $entrada['id_productos'],
						'cantidad' 		=> $entrada['cantidad'],
						'id_trans' 		=> $id_trans,
						'activo' 			=> 1,
						);

		$insert_stock_actual = $this->db->insert('stock_actual', $data);
		if($insert_stock_actual) {
			return true;
		}else {
			return false;
		}

	}

	// public function update($product)
	// {
	// 	unset($product['codigo']);
	// 	// $product['codigo'] = $this->putWellCodigo($product['codigo']);
	// 	$this->db->where('id_productos', $product['id_productos']);
	// 	$this->db->update('productos', $product);
	// 	$update = $this->db->affected_rows();
	// 	if($update == 1) {
	// 		return true;
	// 	}else {
	// 		return false;
	// 	}


	// }

	// // ELIMINA UN PRODUCTO, DEBE CHEQUEAR QUE NO HAYA INGRESADO AL STOCK.
	// public function erase($id_product)
	// {
	// 	$entradas = $this->get_entradas->getByProductos($id_product);


	// 	if(!$entradas)
	// 	{
	// 		$erase = $this->db->delete('productos', array('id_productos' => $id_product));


	// 		if($erase) {
	// 			return true;
	// 		}
	// 	}

	// 	return false;
	// }




}

?>
