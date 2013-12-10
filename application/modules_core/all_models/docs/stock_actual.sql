--
-- 1 oct 2013 -- 14.45
--

ALTER TABLE  `stock_actual` ADD  `memo` LONGTEXT NULL ;

ALTER TABLE  `stock_actual` ADD  `id_trans` INT( 11 ) NULL ,
ADD  `activo` INT( 1 ) NULL COMMENT  '0. inactivo  |  1. activo';