<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo_productos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	public function getProductos( $filter )
	{
		$limit =$filter['limit'];

		if (isset($filter['category_filter']) && $filter['category_filter']) {
			// filtrado por categoria
			$filter = 'AND P.id_categorias = ' . (int) $filter['category_id'];
		}else if( isset($filter['category_filter']) && !$filter['category_filter'] ) {
			$filter = '';
		}else {
			$filter = '';
		}

		$sql = "SELECT * FROM productos P
				JOIN categorias C
					ON P.id_categorias=C.id_categorias
				WHERE C.activo=1 AND P.activo=1 $filter $limit";
		$query = $this->db->query($sql);
		return $query->result_array();

	}






}

?>
