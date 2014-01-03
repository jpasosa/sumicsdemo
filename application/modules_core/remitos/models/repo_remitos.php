<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo_remitos extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}



	/**
	 * Validación de los datos de cabecera del remito.
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	3 de enero del 2014
	 *
	 * @return      boolean (true si los datos son correctos)
	 **/
	public function validate($remito_header)
	{
		try {

			$errors = Array();

			$validate_fecha = existDate($remito_header['fecha']);
			if (!$validate_fecha) {
				$errors['fecha_invalida'] = 'La fecha no es existente';
			}
			if ($remito_header['destino'] == '') {
				$errors['falta_destino'] = 'Debe ingresar un destino';
			}

			return $errors;


		} catch (Exception $e) {
			return NULL;
		}

	}



	/**
	 * Inserta en la tabla remitos
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	3 de enero del 2014
	 *
	 * @return      int (el número de id del registro insertado)
	 **/
	public function insertHeader($header)
	{
		try {

			// Transformo la fecha para poder insertarla correctamente en la tabla.
			$header['fecha'] = esToMysql($header['fecha']);

			$data = array(
					   'fecha'			=> $header['fecha'],
					   'destino' 			=> $header['destino'],
					   'observaciones' 	=> $header['observaciones'],
					   'anulado' 			=> 0,
					   'en_proceso' 		=> 1
					);
			$this->db->insert('remitos', $data);
			if ($this->db->affected_rows()) {
				return (int)$this->db->insert_id();
			} else {
				return 0;
			}

		} catch (Exception $e) {
			return 0;
		}
	}


	/**
	 * Hace un update de la tabla remitos
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	3 de enero del 2014
	 *
	 * @return      boolean (true si hizo correctamente el update)
	 **/
	public function updateHeader($header, $id_remito)
	{
		$header['fecha'] = esToMysql($header['fecha']);

		$data = array(
					   'fecha'			=> $header['fecha'],
					   'destino' 			=> $header['destino'],
					   'observaciones' 	=> $header['observaciones'],
					   'anulado' 			=> 0,
					   'en_proceso' 		=> 1
					);

		$this->db->where('id_remitos', $id_remito);
		$this->db->update('remitos', $data);
	}




}

?>
