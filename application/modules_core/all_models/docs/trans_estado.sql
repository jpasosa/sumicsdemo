


-- COPIO TODOS LOS DATOS, ESTOS DATOS SON LOS QUE DEBEN IR EN ESTA TABLA. NO SE DEBERÍA EDITAR ESTO.




--
--  18 Oct 2013 -- 16.26
--


ALTER TABLE `trans_estado` CHANGE `id_trans_estado` `id_trans_estado` INT( 11 ) NOT NULL AUTO_INCREMENT ;


-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2013 at 04:30 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sumi_cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `trans_estado`
--

CREATE TABLE IF NOT EXISTS `trans_estado` (
  `id_trans_estado` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_trans_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `trans_estado`
--

INSERT INTO `trans_estado` (`id_trans_estado`, `accion`) VALUES
(1, 'Ingreso al Stock de un Producto'),
(2, 'Salida de un producto del Stock'),
(3, 'Alta de un producto'),
(4, 'Baja de un producto.'),
(5, 'Alta de Producto'),
(6, 'Baja de Producto'),
(7, 'Alta de Categoría'),
(8, 'Baja de Categoríá'),
(9, 'Alta de Tipo de Documento'),
(10, 'Baja de Tipo de Documento');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



