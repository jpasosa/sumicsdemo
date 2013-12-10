<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_trans extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	/**
	 * Hace el insert en la tabla trans para llevar el historial del sistema.
	 * Debe usar el id 7, que es una entrada de un productos, este id no
	 * hay que modificarlo nunca de la tabla
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	10 de diciembre del 2013
	 *
	 * @return      booleano ( si realizó correctamente el insert)
	 **/

	public function insertEntradas( $id_tabla )
	{
		$data_insert = array(	'id_trans_estado' 	=> 7,
								'id_usuario' 			=> $this->session->userdata('id_usuario'),
								'fecha' 				=> date('Y-m-d'),
								'id_tabla' 			=> $id_tabla
							);

		$insert_entrada = $this->db->insert('trans', $data_insert);

		if ($insert_entrada) {
			return true;
		} else {
			return false;
		}

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
