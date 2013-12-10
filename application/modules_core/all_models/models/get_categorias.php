<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_categorias extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function getAll()
	{
		try {
			$sql = "SELECT * FROM categorias C WHERE activo = 1";
			$query = $this->db->query($sql);
			return $query->result_array();

		} catch (Exception $e) {
			return array();
		}
	}

	public function getByCodigoAbrev($abrev)
	{
		try {
			$sql = "SELECT * FROM categorias C WHERE codigo_abrev = '$abrev' ";
			$query = $this->db->query($sql);
			$result = $query->result_array();

			if(isset($result[0])) {
				return $result[0];
			} else {
				return false; // NO ENCONTRO EL REGISTRO CON ESE CODIGO_ABREV
			}

		} catch (Exception $e) {
			return array();
		}
	}

	public function getById($id)
	{
		try {
			$sql = "SELECT * FROM categorias C WHERE id_categorias = $id ";
			$query = $this->db->query($sql);
			$result = $query->result_array();

			if(isset($result[0])) {
				return $result[0];
			} else {
				return false; // NO ENCONTRO EL ID
			}

		} catch (Exception $e) {
			return array();
		}
	}





}

?>
