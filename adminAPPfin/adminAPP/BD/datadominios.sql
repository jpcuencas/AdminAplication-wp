-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2014 a las 11:33:13
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

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`ID`, `nombre`, `id_servidor`, `id_tipo`, `registro_en`, `valores`, `idioma`, `id_plantilla`, `title`, `keywords`, `descripcion`, `estado`) VALUES
(1, 'bonosdescuento.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"francisco","contrasenya_wp":"1234"}', 'ES_ES', '2', '', '', '', 'I'),
(2, 'carretillas.org', 1, 1, 'www.dondominio.com', '{"usuario_wp":"francisco","contrasenya_wp":"1234"}', 'ES_ES', '2', '', '', '', 'I'),
(4, 'descuentomoda.com', 1, 1, 'www.dondominio.com', '', 'ES_ES', '2', '', '', '', 'I'),
(5, 'descuentosparaviajar.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepito","contrasenya_wp":"1234"}', 'ES_ES', '2', '', '', '', 'I'),
(6, 'parfums-club.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"maria","contrasenya_wp":"1234"}', 'FR_FR', '4', '', '', '', 'I'),
(7, 'rabatt-codes.info', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepito","contrasenya_wp":"1234"}', 'ES_ES', '2', '', '', '', 'I'),
(8, 'scontiperviaggiare.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"Antonio","contrasenya_wp":"1234"}', 'IT_IT', '5', '', '', '', 'I'),
(9, 'todoinstrumentos.com', 1, 1, 'www.dondominio.com', '{"usuario_wp":"pepon","contrasenya_wp":"1234"}', 'ES_ES', '2', '', '', '', 'I'),
(10, 'buonosconto.info', 1, 1, 'www.dondominio.com', '{"usuario_wp":"juanito","contrasenya_wp":"1234"}', 'IT_IT', '5', '', '', '', 'I'),
(11, 'lola.es', 1, 1, 'www.midominio.com', '{"usuario_wp":"","contrasenya_wp":""}', 'ES_ES', '2', '', '', '', 'I'),
(12, 'pepito.com', 1, 3, 'www.midominio.com', '{"titulo":"Hola","texto":"Feo"}', 'ES_ES', '9', '', '', '', 'I'),
(13, 'pepon.com', 1, 3, 'www.midominio.com', '{"titulo":"dfghdcg","texto":"dfgdgfdfg"}', 'ES_ES', '9', '', '', '', 'I'),
(14, 'jaimito.com', 1, 5, 'www.midominio.com', '{"titulo":"Hola ry","texto":"tu dominio Holajjj","precio":"40"}', 'ES_ES', '8', '', '', '', 'I');

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

--
-- Volcado de datos para la tabla `servidor`
--

INSERT INTO `servidor` (`ID`, `nombre`, `proveedor`, `ip`, `usuario_web`, `contrasenya_web`, `servidor_ftp`, `usuario_ftp`, `contrasenya_ftp`) VALUES
(1, 'www.fiveblogs1.com', 'www.miserver.com', '23.89.199.222', 'www-web', '1234', 'descuentosparaviajar.com', 'descuentoftpu', '789654');

--
-- Volcado de datos para la tabla `tipopagina`
--

INSERT INTO `tipopagina` (`ID`, `nombre`, `descripcion`, `formato`) VALUES
(1, 'Blog', 'blog', 'usuario_wp,Usuario wordpress,texto\r\ncontrasenya_wp,Contrase&ntilde;a,texto'),
(2, 'manual', 'manual', ''),
(3, 'Html', 'Html ', 'titulo,Titulo H1,texto\r\ntexto,Texto,vartexto'),
(4, 'Web', 'Pagina web completa', 'titulo,Titulo H1,texto\r\ntexto,Texto,vartexto\r\nemail,Email,email\r\nurl,Direccion del sitio,url'),
(5, 'venta dominio', 'Web de venta de un dominio', 'titulo,Titulo H1,texto\r\ntexto,Texto,vartexto\r\nprecio,Precio,numero');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
