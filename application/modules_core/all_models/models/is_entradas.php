<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Is_entradas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function existTipoDocumento($id_tipo)
	{
		try {
			$sql = "SELECT * FROM entradas E
					WHERE E.id_tipodocumento = $id_tipo";
			$query = $this->db->query($sql);

			$entradas = $query->result_array();

			if (isset($entradas[0])) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			return array();
		}
	}




}

?>



