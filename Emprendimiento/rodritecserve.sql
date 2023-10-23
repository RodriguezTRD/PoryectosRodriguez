CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nombreusuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_perfil` BLOB,
  `avatar_cambiado` BLOB,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11;
