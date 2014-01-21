<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockactual_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	/**
	 * Nos devuelve el registro del stock_actual
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	16 de enero del 2014
	 *
	 * @return      Array()
	 **/
	public function getStockActual($id_stockactual)
	{
		try {

			$q = $this->db->get_where('stock_actual', array('id_stockactual' => $id_stockactual));
			$stock 	= $q->result_array();

			if (isset($stock[0])) {
				return $stock[0];
			} else {
				return array();
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



}

?>
