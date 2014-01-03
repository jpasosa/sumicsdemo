<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * Función para la validación de una fecha.
 * Debe ingresar la fecha con el formato dd/mm/yyyy, si no ingresa de esa manera
 * no funciona correctamente la validación.
 *
 * @team 	Senaf
 * @author 	juampa <jpasosa@gmail.com>
 * @date 	3 de enero del 2014
 *
 * @return      boolean (true si la fecha es correcta)
 **/
function existDate($date) {

	if ($date == '') {
		$val_fecha = false;
	}
	$date_explotada = explode('/', $date);

	$dia 	= (int)$date_explotada[0];
	$mes 	= (int)$date_explotada[1];
	$anio 	= (int)$date_explotada[2];

	$val_fecha = checkdate( $mes , $dia , $anio );

	return $val_fecha;

}

/**
 * Nos arregla la fecha para insertarla utilizando mysql
 * IMPORTANTE: Debe ser la fecha tipo dd/mm/yyyy
 *
 * @team 	Senaf
 * @author 	juampa <jpasosa@gmail.com>
 * @date 	3 de enero del 2014
 *
 * @return      date()
 **/
function esToMysql($date)
{
	$date = str_replace('/', '-', $date);
	$date = date('Y-m-d',strtotime($date));
	return $date;
}

function mysqlToEs($date)
{
	$date = str_replace('-', '/', $date);
	$date = date('d/m/Y',strtotime($date));
	return $date;
}








?>
