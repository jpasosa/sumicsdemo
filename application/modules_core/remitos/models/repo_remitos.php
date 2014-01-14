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
	 * Inserta item en la tabla remitos_productos
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	7 de enero
	 *
	 * @return      int (0 si no pudo insertar. O el id si insertó correctamente.)
	 **/
	public function insertItem($item, $id_remito)
	{
		try {

			$data = array(
					   'id_remitos'		=> $id_remito,
					   'id_productos' 		=> $item['producto'],
					   'cantidad' 			=> $item['cantidad']
					);
			$this->db->insert('remitos_productos', $data);
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

	/**
	 * Nos devuelve todos los items que están cargados hasta el momento.
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	7 de enero del 2014
	 *
	 * @return      Array()
	 **/
	public function getAllItems($id_remitos)
	{
		try {

			$sql = "SELECT *
					FROM remitos_productos RP
					INNER JOIN remitos R
						ON RP.id_remitos=R.id_remitos
					INNER JOIN productos P
						ON RP.id_productos=P.id_productos
					WHERE RP.id_remitos = $id_remitos
						AND R.en_proceso = 1";
			$q 		= $this->db->query($sql);
			$result	= $q->result_array();

			if ( count($result) > 0) {
				return $result;
			} else {
				return NULL;
			}

		} catch (Exception $e) {
			return NULL;
		}

	}

	/**
	 * Nos devuelve todos los productos disponibles en el stock
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	14 de enero del 2014
	 *
	 * @return      Array()
	 **/
	public function getAllStock()
	{

		try {

			$sql 	= "	SELECT *
						FROM stock_actual SA
						INNER JOIN productos P
							ON SA.id_productos=P.id_productos
						WHERE SA.activo=1
						";
			$q 		= $this->db->query($sql);
			$result	= $q->result_array();

			if ( count($result) > 0) {
				return $result;
			} else {
				return NULL;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	/**
	 * Va a controlar que haya la cantidad suficiente en stock.
	 *
	 * @team 	Senaf
	 * @author 	juampa <jpasosa@gmail.com>
	 * @date 	14 de enero del 2014
	 *
	 * @return      array() vacio si no hay errores. Si no, nos dice el mensaje del error
	 **/
	public function validateItem($item)
	{

		try {
			$error = array();

			$data = array(
						   'id_productos' 		=> $item['producto'],
						   'cantidad' 			=> $item['cantidad']
						);
			$query 	= $this->db->get_where('stock_actual', array('id_productos' => $data['id_productos']));
			$result 	= $query->result_array();

			if (isset($result[0]) && $result[0]['activo'] == 1) {
				$qty 	= $result[0]['cantidad'];
				if ($qty >= $data['cantidad']) {
					return array();
				} else {
					return $error['max'] = 'La cantidad disponibles en stock es de ' . $qty . ' para dicho producto.';
				}
			} else {
				return false;
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}




}

?>
