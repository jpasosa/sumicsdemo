<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_productos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->config('estados');
	}

	public function validateAdd($product)
	{
		$errors = false;

		if($product['descripcion'] == '') {
			$errors['descripcion'] = 'La descripcion es obligatoria';
		}

		if($product['detalle'] == '') {
			$errors['descripcion'] = 'El detalle es obligatorio';
		}

		if($product['id_categorias'] == '') {
			$errors['id_categorias'] = 'Debe indicar la categoría';
		}

		return $errors;
	}

	public function validateEdit($product)
	{
		$errors = false;

		if($product['descripcion'] == '') {
			$errors['descripcion'] = 'La descripcion es obligatoria';
		}

		if($product['detalle'] == '') {
			$errors['descripcion'] = 'El detalle es obligatorio';
		}

		if($product['id_categorias'] == '') {
			$errors['id_categorias'] = 'Debe indicar la categoría';
		}

		$chech_category = $this->checkCodeWithCategory($product['codigo'], $product['id_categorias']);

		if(!$chech_category) {
			$errors['code_category'] = 'No coincida la categoría con el código del producto.';
		}

		return $errors;
	}

	public function insert($product)
	{
		$product['codigo'] 	= $this->putWellCodigo($product['id_categorias']);
		$product['activo'] 	= 1;
		$insert_prod = $this->db->insert('productos', $product);

		if($insert_prod)
		{
			$id_productos = $this->db->insert_id();
			$trans = $this->repo_trans->addTrans( $id_productos );
			if ( $trans ) {
				return true;
			} else {
				return false;
			}
		}else {
			return false;
		}

	}

	public function update($product)
	{
		unset($product['codigo']);
		// $product['codigo'] = $this->putWellCodigo($product['codigo']);
		$this->db->where('id_productos', $product['id_productos']);
		$this->db->update('productos', $product);
		$update = $this->db->affected_rows();
		if($update == 1) {
			$trans = $this->repo_trans->addTrans( $product['id_productos'] );
			if ( $trans ) {
				return true;
			} else {
				return false;
			}


			return true;
		}else {
			return false;
		}


	}

	// ELIMINA UN PRODUCTO, DEBE CHEQUEAR QUE NO HAYA INGRESADO AL STOCK.
	public function erase($id_product)
	{
		$entradas = $this->get_entradas->getByProductos($id_product);


		if(!$entradas)
		{

			$this->db->where('id_productos', $id_product);
			$this->db->update('productos', array('activo' => 0));
			$erase = $this->db->affected_rows();

			if($erase) {
				$trans = $this->repo_trans->addTrans( $id_product );
				if ( $trans ) {
					return true;
				} else {
					return false;
				}
			}
		}

		return false;
	}

	public function countAll()
	{
		try
		{
			$sql = 'SELECT COUNT(P.id_productos) as "max"
			FROM productos P WHERE P.activo=1
			';

			$query = $this->db->query($sql);
			$rows = $query->row_array();
			if($rows['max'] <= 0 ){
				return 0;
			}
			else{
				return $rows['max'];
			}

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
			return 0;
		}
	}

	public function countAllByCategory($id_category)
	{
		try
		{
			$sql = "SELECT COUNT(P.id_productos) as max
					FROM productos P
					WHERE id_categorias = $id_category AND P.activo=1";

			$query = $this->db->query($sql);
			$rows = $query->row_array();
			if($rows['max'] <= 0 ){
				return 0;
			}
			else{
				return $rows['max'];
			}

		} catch (Exception $e) {
			throw new Exception($e->getMessage());
			return 0;
		}
	}


	// VALIDA EL CAMPO CODIGO
	// private function validateCodigo($code) {
	// 	$ret['validado']	= true;
	// 	$ret['message']	= '';
	// 	$code 			= trim($code);
	// 	$code_explode 	= explode(" ", $code);


	// 	// Si no son dos terminos esta mal el codigo. Deben ser dos términos separados por un espacio.
	// 	if(count($code_explode) != 2) {
	// 		$ret['validado'] 	= false;
	// 		$ret['message'] = 'Código incorrecto. Deben ser dos términos separados por un espacio';
	// 		return $ret;
	// 	} else {
	// 		$cod_abrev = strtoupper($code_explode[0]);
	// 		$numeros 	= $code_explode[1];
	// 	}

	// 	// CONTROLA QUE EXISTA EL CODIGO DE ABREVIACION
	// 	$exist_abrev = $this->get_categorias->getByCodigoAbrev($cod_abrev);
	// 	if(!$exist_abrev) {
	// 		$ret['validado'] 	= false;
	// 		$ret['message'] 	= 'El código de la categoria cargado no existe.';
	// 		return $ret;
	// 	}

	// 	// CONTROLA QUE LOS NUMEROS NO SE PASEN DE 5CARACTERES Y QUE SEAN SOLO NUMEROS
	// 	$patron = "/^[[:digit:]]+$/";
	// 	if (preg_match($patron, $numeros)) {
	// 		$cant_numeros = strlen($numeros);
	// 		if($cant_numeros > 5) {
	// 			$ret['validado'] 		= false;
	// 			$ret['message'] 	= 'El código está mal escrito. Hay más de 5 dígitos en los números.';
	// 			return $ret;
	// 		}
	// 	} else {
	// 		$ret['validado'] 		= false;
	// 		$ret['message'] 	= 'Código incorrecto. No van letras en numeración.';
	// 		return $ret;
	// 	}

	// 	// CONTROLA QUE NO EXISTA EL CÓDIGO
	// 	$code_for_insert = $this->putWellCodigo($code);
	// 	$exist_code = $this->is_productos->existCodigo($code_for_insert);
	// 	if($exist_code) {
	// 		$ret['validado'] 		= false;
	// 		$ret['message'] 	= 'Código ya existente.';
	// 		return $ret;
	// 	}

	// 	return $ret;
	// }

	// PONE EL CÓDIGO DEL PRODUCTO QUE DEBE IR AUTOMÁTICAMENTE. SELECCIONA EL MAYOR ID
	// QUE CORESPONDA A LA CATEGORIA DADA Y PONE XXX - 99999
	private function putWellCodigo($id_category) {
		// tengo que saber si existe algún producto con esta categoria.
		$exist_product = $this->is_productos->existProductWithCategory($id_category);

		if ($exist_product)
		{
			// Busco el último id de la categoria dada
			$sql = "SELECT * FROM productos P
						WHERE P.id_categorias = $id_category
						ORDER BY id_productos DESC LIMIT 1" ;
			$query = $this->db->query($sql);

			$last_id_category = $query->result_array();

			if (isset($last_id_category[0])) {
				$last_code = $last_id_category[0]['codigo'];
			} else {
				$last_code = 0;
			}

			$last_code 			= trim($last_code);
			$code_explode 		= explode("-", $last_code);
			$new_numeric_code= $code_explode[1] + 1;

			// CODIFICO LOS NUMEROS
			$count_num = mb_strlen( $new_numeric_code );
			if($count_num == 1) {
				$new_numeric_code = '0000' . $new_numeric_code;
			}elseif ($count_num == 2) {
				$new_numeric_code = '000' . $new_numeric_code;
			}elseif ($count_num == 3) {
				$new_numeric_code = '00' . $new_numeric_code;
			}elseif ($count_num == 4) {
				$new_numeric_code = '0' . $new_numeric_code;
			}
			$code = strtoupper(trim($code_explode[0])) . ' - ' . $new_numeric_code;

		} else { // NO HAY NINGÚN PRODUCTO CON ESA CATEGORÍA TODAVÍÁ

			$code_abrev = $this->get_categorias->getById($id_category);
			$code_abrev = trim($code_abrev['codigo_abrev']);

			$code = $code_abrev . ' - ' . '00000';
		}





		return $code;
	}

	private function checkCodeWithCategory($code, $category)
	{
		$code_explode = explode("-", $code);
		$letters_code = trim($code_explode[0]);
		$cat 			= $this->get_categorias->getById($category);
		$code_abrev 	= trim($cat['codigo_abrev']);

		if ($code_abrev != $letters_code) {
			return false;
		} else {
			return true;
		}
	}

	// SACA EL GUION DEL MEDIO DEL PRODUCTO, PARA QUE PODAMOS EDITARLO
	public function removeCodeGuion($code) {
		$code = trim($code);
		$code_explode = explode("-", $code);
		if(isset($code_explode[0]) && isset($code_explode[1]))
		{
			$cod_abrev		= trim($code_explode[0]);
			$numeros 		= trim($code_explode[1]);
			$code 			= $cod_abrev . ' ' . $numeros;
		}


		return $code;
	}



}

?>
