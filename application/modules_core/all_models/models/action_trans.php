<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_trans extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}



	public function insertEntradas()
	{
		$this->db->set('id_trans_estado', 1);
		$insert_entrada = $this->db->insert('trans');

		return $this->db->insert_id();
	}

	// public function update($category)
	// {
	// 	$category['codigo_abrev'] = strtoupper($category['codigo_abrev']);



	// 	$this->db->where('id_categorias', $category['id_categorias']);
	// 	$this->db->update('categorias', $category);
	// 	$update = $this->db->affected_rows();

	// 	if($update == 1) {
	// 		return true;
	// 	}else {
	// 		return false;
	// 	}


	// }

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
