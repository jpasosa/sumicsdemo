<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo_entradastock extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	/**
	 * Ingreso la entrada del Stock en stock_actual
	 * Debe primero buscar si existe ese id_productos, y si es así, debe actualizar el registro
	 * Si no fuera así, debe insertar un nuevo registro con la cantidad del producto.
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	6 de enero del 2014
	 *
	 * @return      boolean (true si ingreso correctamente)
	 **/
	public function updateStockActual($entrada)
	{

		$exist_product = $this->existProduct($entrada['id_productos']);
		if ($exist_product > 0) {
			// Actualiza el registro

			// Sumo cantidades
			$cant_anterior = $this->getCantidad($exist_product);
			$data = array(
					   'cantidad' 		=> ($cant_anterior + $entrada['cantidad'])
			            );

			$this->db->where('id_stockactual', $exist_product);
			$this->db->update('stock_actual', $data);

		} else {
			// Inserta un nuevo registro
			$data = array(
					   'id_productos' => $entrada['id_productos'] ,
					   'cantidad' 		=> $entrada['cantidad'] ,
					   'activo' 		=> 1
					);
			$this->db->insert('stock_actual', $data);
		}

		if($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}


	}



	/**
	 * Nos determina si ya existe cargado dicho producto en la tabla stock_actual
	 * Si ya existe nos devuelve el id de la tabla stock_actual. Si no es así, nos devuelve 0
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	6 d enero del 2014
	 *
	 * @return      (int) 0 o id_stockactual
	 **/
	private function existProduct($id_productos)
	{
		$sql 	= "SELECT * FROM stock_actual WHERE id_productos = $id_productos AND activo = 1";
		$q 		= $this->db->query($sql);
		$result	= $q->result_array();
		if(isset($result[0])) {
			return (int)$result[0]['id_stockactual'];
		} else {
			return (int)0;
		}
	}




	/**
	 * Nos devuelve la cantidad del stock actual
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	6 de enero
	 *
	 * @return      int (la cantidad del producto)
	 **/
	private function getCantidad($id_stockactual)
	{
		$sql 	= "SELECT * FROM stock_actual WHERE id_stockactual = $id_stockactual AND activo = 1";
		$q 		= $this->db->query($sql);
		$result	= $q->result_array();
		if(isset($result[0])) {
			return (int)$result[0]['cantidad'];
		} else {
			return (int)0;
		}

	}






}

?>
