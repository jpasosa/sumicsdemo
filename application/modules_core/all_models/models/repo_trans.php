<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo_trans extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function addTrans( $id_tabla )
	{
		// Rastreo de donde es llamado el método.
		$exception 	= new Exception;
        	$trace 		= $exception->getTrace();

        	$file_array 	= explode('/', $trace[1]['file']);
        	$file 		= end($file_array);
        	$function 	= $trace[1]['function'];
       	$class 		= $trace[1]['class'];

        	if ( $file == 'productos.php' && $function == 'insert' && $class == 'Action_productos')
        	{ 	// ALTA DE PRODUCTOS
        		$insert_trans = $this->insertTrans( $id_tabla, 'insert.producto' );
        		$trans_ok = $insert_trans  ? true : false;

        	} elseif ( $file == 'productos.php' && $function == 'update' && $class == 'Action_productos')
        	{ 	// EDICIÓN DE PRODUCTOS
        		$insert_trans 	= $this->insertTrans( $id_tabla, 'update.producto' );
        		$trans_ok 		= $insert_trans  ? true : false;

        	} elseif ( $file == 'all_models.php' && $function == 'erase' && $class == 'Action_productos')
        	{ 	// BAJA DE PRODUCTOS
        		$insert_trans 	= $this->insertTrans( $id_tabla, 'delete.producto' );
        		$trans_ok 		= $insert_trans  ? true : false;

		} elseif ( $file == 'productos.php' && $function == 'insert' && $class == 'Action_categorias' )
        	{ 	// ALTA DE CATEGORÍA
      		$insert_trans 	= $this->insertTrans( $id_tabla, 'insert.categoria' );
        		$trans_ok 		= $insert_trans  ? true : false;

        	} elseif ( $file == 'productos.php' && $function == 'update' && $class == 'Action_categorias' )
        	{ 	// EDICION DE CATEGORÍA
      		$insert_trans 	= $this->insertTrans( $id_tabla, 'update.categoria' );
        		$trans_ok 		= $insert_trans  ? true : false;

        	} elseif ( $file == 'all_models.php' && $function == 'eraseCategory' && $class == 'Action_categorias' )
        	{ 	// BAJA DE CATEGORÍA
      		$insert_trans 	= $this->insertTrans( $id_tabla, 'delete.categoria' );
        		$trans_ok 		= $insert_trans  ? true : false;

        	} else {
        		$trans_ok = false;
        	}

        	return $trans_ok;
	}

	private function insertTrans( $id_tabla, $what_table )
	{
		try {

			$do_trans = false;
			if ( $what_table == 'insert.producto' ) {
				$id_trans_estado 	= 4; // ALTA DE PRODUCTO
				$do_trans 			= true;
			} else if ( $what_table == 'update.producto' ) {
				$id_trans_estado 	= 5; // EDICIÓN DE PRODUCTO
				$do_trans 			= true;
			} else if ( $what_table == 'delete.producto' ) {
				$id_trans_estado 	= 6; // ELIMINACIÓN DE PRODUCTO
				$do_trans 			= true;
			} else if ( $what_table == 'insert.categoria' ) {
				$id_trans_estado 	= 1; // ALTA DE CATEGORÍA
				$do_trans 			= true;
			} else if ( $what_table == 'update.categoria' ) {
				$id_trans_estado 	= 2; // EDICIÓN DE CATEGORÍA
				$do_trans 			= true;
			} else if ( $what_table == 'delete.categoria' ) {
				$id_trans_estado 	= 3; // ELIMINACIÓN DE CATEGORÍA
				$do_trans 			= true;
			}

			if ( $do_trans ) // COMIENZA A HACER LAS TRANSACCIONES PARA INSERTAR EN TABLA TRANS
			{
				$insert_data = array( 	'id_trans_estado' => $id_trans_estado,
										'id_usuario' 		=> $this->session->userdata('id_usuario'),
										'fecha'			=> date('Y-m-d'),
										'id_tabla' 		=> $id_tabla
									);
				$insert_trans = $this->db->insert('trans', $insert_data);

				if( $insert_trans ) {
					return true;
				} else {
					return false;
				}
			}






		} catch ( Exception $e ) {
			throw new Exception("Error Processing Request", 1);
			return 0;
		}
	}

	private function insertEdicionProducto( $id_tabla )
	{
		try {

			$insert_data = array( 	'id_trans_estado' => 4,
									'id_usuario' 		=> $this->session->userdata('id_usuario'),
									'fecha'			=> date('Y-m-d'),
									'id_tabla' 		=> $id_tabla
								);
			$insert_trans = $this->db->insert('trans', $insert_data);

			if( $insert_trans )
			{
				$id_tabla_trans = $this->db->insert_id();
				$this->db->where('id_productos', $id_tabla);
				$this->db->update('productos', array('id_trans' => $id_tabla_trans));
				$update = $this->db->affected_rows();
				if($update == 1) {
					return true;
				}else {
					return false;
				}

			} else {
				return false;
			}

		} catch ( Exception $e ) {
			throw new Exception("Error Processing Request", 1);
			return 0;
		}
	}



}

?>
