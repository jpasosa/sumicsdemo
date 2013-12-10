<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_entradas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	// public function insert($category)
	// {
	// 	$category['codigo_abrev'] = strtoupper($category['codigo_abrev']);
	// 	$insert_cat = $this->db->insert('categorias', $category);
	// 	if($insert_cat) {
	// 		return true;
	// 	}else {
	// 		return false;
	// 	}

	// }

	public function update($id_entradas, $id_trans)
	{

		$this->db->where('id_entradas', $id_entradas);
		$this->db->update('entradas', array('id_trans' => $id_trans));

		$update = $this->db->affected_rows();

		if($update == 1) {
			return true;
		}else {
			return false;
		}

	}

	// public function erase($id_category)
	// {
	// 	$products_with_category = $this->get_productos->getByCategory($id_category);

	// 	if(!$products_with_category)
	// 	{
	// 		$erase = $this->db->delete('categorias', array('id_categorias' => $id_category));
	// 		if($erase) {
	// 			return true;
	// 		}
	// 	}

	// 	return false;


	// }

}

?>
