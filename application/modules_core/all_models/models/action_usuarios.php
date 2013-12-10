<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_usuarios extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}


	// Si no existe me devuelve ['idUsuarios'] = 0,  Si existe devuelve el id del User
	public function validate($usuario) {
		try {
				$query = $this->db->query("
											SELECT U.id_usuario, U.email, R.id_rol
											FROM usuarios U
											INNER JOIN roles R
												ON U.id_rol=R.id_rol
											WHERE U.email = " . $this->db->escape($usuario['email']) . "
													AND U.clave = PASSWORD(". $this->db->escape(trim($usuario['clave'])) .")
													AND (U.estado_usuario = 1) " );
				$usuario = $query->row_array();


				if(isset($usuario['id_usuario']) && $usuario['id_usuario'] >= 1) {
						return $usuario;
				} else {
						$rol['id_usuario'] = 0 ;
						return $rol;
				}

		} catch (Exception $e) {
				$rol['idUsuarios'] = 0 ;
				return $rol;
		}
	}


}

?>




