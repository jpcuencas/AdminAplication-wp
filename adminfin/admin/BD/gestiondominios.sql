-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2014 a las 11:34:01
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gestiondominios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE IF NOT EXISTS `dominio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_servidor` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `registro_en` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valores` longtext COLLATE utf8_spanish_ci,
  `idioma` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_plantilla` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`ID`, `nombre`, `id_servidor`, `id_tipo`, `registro_en`, `valores`, `idioma`, `id_plantilla`, `estado`) VALUES
(1, 'bonosdescuento.com', 1, 1, 'www.dondominio.com', '{"title":"","keywords":"Descuento,bonos","descripcion":"una web repleta de descuentos","usuario_wp":"francisco","contrasenya_wp":"1234","Guardar2":"Guardar e Instalar"}', 'ES_ES', '2', 'I'),
(2, 'carretillas.org', 1, 1, 'www.dondominio.com', '{"usuario_wp":"francisco","contrasenya_wp":"1234","keywords":"Carretillas,elevacion,peso","descripcion":"Carretillas elevadoras para todos los gustos"}', 'ES_ES', '2', 'I'),
(3, 'codicesconto.biz', 1, 1, 'www.dondominio.com', '{"usuario_wp":"luis","contrasenya_wp":"1234","keywords":"codicesconto","descripcion":""}', 'ES_ES', '2', 'I'),
(4, 'descuentomoda.com', 1, 1, 'www.dondominio.com', '', 'ES_ES', '2', 'I'),
(5, 'descuentosparaviajar.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepito","contrasenya_wp":"1234","keywords":"Descuentos,viajes,emciones","descripcion":"Unas ideas para viajes inolvidables"}', 'ES_ES', '2', 'I'),
(6, 'parfums-club.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"maria","contrasenya_wp":"1234","keywords":"Perfumes,colonias","descripcion":"una web con olores inolvidables"}', 'FR_FR', '4', 'I'),
(7, 'rabatt-codes.info', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepito","contrasenya_wp":"1234","keywords":"Codigos","descripcion":"Rabatt codigos"}', 'ES_ES', '2', 'I'),
(8, 'scontiperviaggiare.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"Antonio","contrasenya_wp":"1234","keywords":"Descuento,viajes","descripcion":"Una sugerancia para tus viajes"}', 'IT_IT', '5', 'I'),
(9, 'todoinstrumentos.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepon","contrasenya_wp":"1234","keywords":"Instrumento,musica,tono","descripcion":"La web de musica que te alegrara el dia"}', 'ES_ES', '2', 'I'),
(10, 'buonosconto.info', 1, 1, 'www.dondominio.com', '{"usuario_wp":"juanito","contrasenya_wp":"1234","keywords":"Bono,descuento,ahorro","descripcion":"Ahorra sin darte cuenta con tus bonos"}', 'IT_IT', '5', 'I'),
(11, 'lola.es', 1, 1, 'www.midominio.com', '{"usuario_wp":"","contrasenya_wp":"","keywords":"","descripcion":"À Á Â Ã Ä Å Æ Ç È É Ê Ë Ì Í Î Ï Ð Ñ Ò Ó Ô Õ Ö Ø Ù Ú Û Ü Ý Þ ß à á â ã ä å æ ç è é ê ë ì í î ï  ñ ò ó ô õ ö ù ú û ü ý ÿ "}', 'ES_ES', '2', 'I'),
(12, 'pepito.com', 1, 3, 'www.midominio.com', '{"titulo":"Hola","texto":"Feo","keywords":"","descripcion":""}', 'ES_ES', '7', 'I'),
(13, 'pepon.com', 1, 3, 'www.midominio.com', '{"titulo":"dfghdcg","texto":"dfgdgfdfg","keywords":"dfgdgfdg","descripcion":"dfgdgfdfg"}', 'ES_ES', '9', 'I'),
(14, 'jaimito.com', 1, 5, 'www.midominio.com', '{"titulo":"Hola ry","texto":"tu dominio Holajjj","precio":"40","keywords":"hola como vA","descripcion":"la web del saludo por excelencia","title":"Hola ry"}', 'ES_ES', '8', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE IF NOT EXISTS `plantilla` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `plantilla`
--

INSERT INTO `plantilla` (`ID`, `nombre`, `id_tipo`, `descripcion`) VALUES
(1, 'wordpress_basico_de', 1, 'plantilla en aleman'),
(2, 'wordpress_basico_es', 1, 'plantilla en español'),
(3, 'wordpress_basico_en', 1, 'plantilla en ingles'),
(4, 'wordpress_basico_fr', 1, 'plantilla en frances'),
(5, 'wordpress_basico_it', 1, 'plantilla en italiano'),
(6, 'wordpress_basico_pt', 1, 'plantilla en portugues'),
(8, 'html_dominio_basico', 5, 'plantilla venta dominio basica'),
(9, 'html_tpl_basico', 3, 'plantilla de php basica'),
(10, 'html_basico_cssjs', 3, 'Pagina basica de html'),
(11, 'html_tpl_basico_cssjs', 3, 'Pagina basica de html con remplazo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidor`
--

CREATE TABLE IF NOT EXISTS `servidor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `proveedor` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_web` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasenya_web` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `servidor_ftp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_ftp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasenya_ftp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `servidor`
--

INSERT INTO `servidor` (`ID`, `nombre`, `proveedor`, `ip`, `usuario_web`, `contrasenya_web`, `servidor_ftp`, `usuario_ftp`, `contrasenya_ftp`) VALUES
(1, 'www.fiveblogs1.com', 'www.miserver.com', '23.89.199.222', 'www-web', '1234', 'descuentosparaviajar.com', 'descuentoftpu', '789654');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopagina`
--

CREATE TABLE IF NOT EXISTS `tipopagina` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `formato` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipopagina`
--

INSERT INTO `tipopagina` (`ID`, `nombre`, `descripcion`, `formato`) VALUES
(1, 'Blog', 'blog', 'title,Title de la pagina(meta),texto\r\nkeywords,Keywords separado por comas(meta),texto\r\ndescripcion,Descripcion(meta),vartexto\r\nusuario_wp,Usuario wordpress,texto\r\ncontrasenya_wp,Contrase&ntilde;a,texto'),
(2, 'manual', 'manual', ''),
(3, 'Html', 'Html ', 'title,Title de la pagina(meta),texto\r\ndescripcion,Metaetiqueta Descripcion,vartexto\r\nkeywords,Metaetiqueta Keywords (separado por comas),texto\r\ntitulo,Titulo H1,texto\r\ntexto,Texto,texto'),
(4, 'Web', 'Pagina web completa', 'title,Title de la pagina(meta),texto\r\nkeywords,Keywords separado por comas(meta),texto\r\ndescripcion,Descripcion(meta),vartexto\r\ntitulo,Titulo H1,texto\r\ntexto,Texto,texto\r\nemail,Email,email\r\nurl,Direccion del sitio,url'),
(5, 'venta dominio', 'Web de venta de un dominio', 'title,Title de la pagina(meta),texto\r\nkeywords,Keywords separado por comas(meta),texto\r\ndescripcion,Descripcion(meta),vartexto\r\ntitulo,Titulo H1,texto\r\ntexto,Texto,texto\r\nprecio,Precio,numero');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
