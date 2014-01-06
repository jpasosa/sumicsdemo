<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Helper para sesiones, re-utilizo del proyecto viejo.


function fillSession($data,$session){
		$my_data = array(
					'id_usuario' 	=> $data['id_usuario'],
					'email' 		=> $data['email'],
					'id_rol' 		=> $data['id_rol']
					);
		$session->set_userdata($my_data);
		unset($data);
		unset($my_data);
}


function checkRol($rol,$session){
		if(ROL_KEY == $session->userdata('rolKey')) {
			return true;
		}
		elseif ($rol == $session->userdata('rolKey')) {
			return true;
		}else {
			return false;
		}
}

function getPerm($permiso,$session) {
		$permiso = strtolower($permiso);
		$data = $session->userdata('permisos');
		foreach($data['permisos'] as $miPermiso) {
						if($permiso == strtolower($miPermiso['permKey']) ) {
										return $miPermiso['permValue'];
						}
		}
		return false;
}


function isLogged($session){
		if($session->userdata('id_usuario')) {
			return true;
		}else {
			return false;
		}
}

function isAdmin($session){
		$roles = $session->userdata('permisos');
		if($roles['idRoles'] == 1) {
				return true;
		}else {
				return false;
		}
}

/**
 * Destruye la session del encabezado del remito
 * si es que existe
 *
 * @team 	Allytech
 * @author 	juampa <jpasosa@gmail.com>
 * @date 	6 de enero del 2014
 *
 * @return      true
 **/
function dieSessionRemito($session)
{
	if ($session->userdata('id_remitos')) {
		$session->unset_userdata('id_remitos');
	}

	return true;
}




?>
