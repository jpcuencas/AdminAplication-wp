-- MySQL dump 10.13  Distrib 5.1.73, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gestionDominios
-- ------------------------------------------------------
-- Server version	5.1.73-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dominio`
--

DROP TABLE IF EXISTS `dominio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dominio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `id_servidor` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `registro_en` varchar(255) DEFAULT NULL,
  `valores` longtext,
  `idioma` varchar(255) DEFAULT NULL,
  `id_plantilla` varchar(255) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `keywords` text,
  `descripcion` text,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dominio`
--

LOCK TABLES `dominio` WRITE;
/*!40000 ALTER TABLE `dominio` DISABLE KEYS */;
INSERT INTO `dominio` VALUES (1,'bonosdescuento.com',1,8,'www.dondominio.com','{\"usuario_wp\":\"\",\"contrasenya_wp\":\"\"}','ES_ES','','','','','I'),(2,'carretillas.org',1,1,'www.dondominio.com','{\"usuario_wp\":\"francisco\",\"contrasenya_wp\":\"1234\"}','ES_ES','2','','','','I'),(15,'josele.es',1,1,'www.midominio.com','{\"usuario_wp\":\"pepe\",\"contrasenya_wp\":\"1234\",\"titulo\":\"Pagina de josele\"}','ES_ES','2','Pagina de josele','josele,paguina,web','La pagina web de josele','I'),(4,'descuentomoda.com',1,1,'www.dondominio.com','','ES_ES','2','','','','I'),(5,'descuentosparaviajar.com',1,1,'www.dondominio.com','{\"usuario_wp\":\"pepito\",\"contrasenya_wp\":\"1234\"}','ES_ES','2','','','','I'),(6,'parfums-club.com',1,1,'www.dondominio.com','{\"usuario_wp\":\"maria\",\"contrasenya_wp\":\"1234\"}','FR_FR','4','','','','I'),(7,'rabatt-codes.info',1,1,'www.dondominio.com','{\"usuario_wp\":\"pepito\",\"contrasenya_wp\":\"1234\"}','ES_ES','2','','','','I'),(8,'scontiperviaggiare.com',1,1,'www.dondominio.com','{\"usuario_wp\":\"Antonio\",\"contrasenya_wp\":\"1234\"}','IT_IT','5','','','','I'),(9,'todoinstrumentos.com',1,1,'www.dondominio.com','{\"usuario_wp\":\"pepon\",\"contrasenya_wp\":\"1234\"}','ES_ES','2','','','','I'),(10,'buonosconto.info',1,1,'www.dondominio.com','{\"usuario_wp\":\"juanito\",\"contrasenya_wp\":\"1234\"}','IT_IT','5','','','','I'),(11,'lola.es',1,1,'www.midominio.com','{\"usuario_wp\":\"\",\"contrasenya_wp\":\"\"}','ES_ES','2','','','','I'),(12,'pepito.com',1,3,'www.midominio.com','{\"titulo\":\"Hola\",\"texto\":\"Feo\"}','ES_ES','9','','','','I'),(13,'pepon.com',1,3,'www.midominio.com','{\"titulo\":\"dfghdcg\",\"texto\":\"dfgdgfdfg\"}','ES_ES','9','','','','I'),(14,'jaimito.com',1,5,'www.midominio.com','{\"titulo\":\"Hola ry\",\"texto\":\"tu dominio Holajjj\",\"precio\":\"40\"}','ES_ES','8','','','','I'),(25,'cupoauto.com',1,1,'dondominio.com','{\"usuario_wp\":\"cupon\",\"contrasenya_wp\":\"1234\",\"titulo\":\"Cupoauto\"}','ES_ES','18','Cupoauto','keywords cupoauto','Descripcion cupoauto','I'),(24,'ffffffffff',1,1,'www.midominio.com','{\"usuario_wp\":\"SSSS\",\"contrasenya_wp\":\"SSSS\",\"titulo\":\"eoeoeoe\"}','DE_DE','1','eoeoeoe','HJKJ,ASDF,ASFD','AJSDHKAJDAJKD','I'),(16,'dominio1.es',1,6,'www.midominio.com','{\"texto1\":\"Vacia\",\"texto2\":\"Cartera\",\"texto3\":\"Esto es una prueba\",\"textomas\":\"Mas informacion\",\"urlmas\":\"http://miDirecion.es\",\"titulo\":\"mi dominio\"}','ES_ES','13','mi dominio','dominio,uno','el primer dominio del mundo','I'),(18,'pepito.es',1,4,'www.midominio.com','{\"titulo1\":\"Esto es una prueba\",\"subtitulo1\":\"Espero que te guste\",\"preguntacorreo\":\"Contacte con:\",\"frase1\":\"Antonio es el mas guapo\",\"frase2\":\"o no\",\"textoemail\":\"Contacte en:\",\"email\":\"dominio@fivedoorsnetworks.es\",\"facebook\":\"https://www.facebook.com/josele\",\"twitter\":\"https://twitter.com/josele\",\"youtube\":\"https://www.youtube.com/josele\",\"textotelefono\":\"Llame a este telefono\",\"telefono\":\"967143568\",\"titulo\":\"la pagina de pepito\"}','ES_ES','12','la pagina de pepito','pagina,pepito,mola','la pagina de pepito','I'),(19,'lose.es',1,6,'www.dondominio.com','{\"texto1\":\"ANTONIO\",\"texto2\":\"GUAPO\",\"texto3\":\"esto es una prueba\",\"textomas\":\"Mas informacion\",\"urlmas\":\"http://miDirecion.es\",\"titulo\":\"hola1\"}','ES_ES','13','hola1','dhdfhf','haranasdjb','I'),(21,'www.todopepe1.com',1,6,'www.midominio.com','{\"texto1\":\"esto es\",\"texto2\":\"una prueba\",\"texto3\":\"prueba2\",\"textomas\":\"Mas informacion\",\"urlmas\":\"http://www.hola.es\",\"titulo\":\"hola\"}','ES_ES','13','hola','','lololo','I'),(22,'cupoprissimor.net',1,8,'dondominio.com','{\"usuario_wp\":\"pepito\",\"contrasenya_wp\":\"1234\",\"prefijo_wp\":\"wp_\",\"titulo\":\"Esto es el titulo\"}','ES_ES','18','Esto es el titulo','estas, son ,las, keywords','Esto es la descripcion','I');
/*!40000 ALTER TABLE `dominio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plantilla`
--

DROP TABLE IF EXISTS `plantilla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plantilla` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plantilla`
--

LOCK TABLES `plantilla` WRITE;
/*!40000 ALTER TABLE `plantilla` DISABLE KEYS */;
INSERT INTO `plantilla` VALUES (1,'wordpress_basico_de',8,'plantilla en aleman'),(2,'wordpress_basico_es',8,'plantilla en espa&ntilde;ol'),(3,'wordpress_basico_en',8,'plantilla en ingles'),(4,'wordpress_basico_fr',8,'plantilla en frances'),(5,'wordpress_basico_it',8,'plantilla en italiano'),(6,'wordpress_basico_pt',8,'plantilla en portugues'),(8,'html_dominio_basico',5,'plantilla venta dominio basica'),(9,'html_tpl_basico',3,'plantilla de php basica'),(10,'html_basico_cssjs',3,'Pagina basica de html'),(11,'html_tpl_basico_cssjs',3,'Pagina basica de html con remplazo'),(12,'smart_cart',4,'Plantilla Smart cart'),(13,'empty_wallet',6,'Plantilla web2'),(14,'the_deep_blue',7,'Plantilla web3'),(15,'times_a_wastin',4,'Plantilla del reloj'),(18,'Cuponissimo Es',8,'P&aacute;gina autom&aacute;tica de cupones');
/*!40000 ALTER TABLE `plantilla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidor`
--

DROP TABLE IF EXISTS `servidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `proveedor` varchar(255) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `usuario_web` varchar(255) DEFAULT NULL,
  `contrasenya_web` varchar(255) DEFAULT NULL,
  `servidor_ftp` varchar(255) DEFAULT NULL,
  `usuario_ftp` varchar(255) DEFAULT NULL,
  `contrasenya_ftp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidor`
--

LOCK TABLES `servidor` WRITE;
/*!40000 ALTER TABLE `servidor` DISABLE KEYS */;
INSERT INTO `servidor` VALUES (1,'www.fiveblogs1.com','www.miserver.com','23.89.199.222','www-web','1234','descuentosparaviajar.com','descuentoftpu','789654');
/*!40000 ALTER TABLE `servidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipopagina`
--

DROP TABLE IF EXISTS `tipopagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipopagina` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `formato` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipopagina`
--

LOCK TABLES `tipopagina` WRITE;
/*!40000 ALTER TABLE `tipopagina` DISABLE KEYS */;
INSERT INTO `tipopagina` VALUES (1,'Blog','blog','usuario,Usuario wordpress,texto\r\ncontrasenya,Contrase&ntilde;a,texto'),(2,'manual','manual',''),(3,'Html','Html ','titulo,Titulo H1,texto\r\ntexto,Texto,vartexto'),(4,'Web','Pagina web completa','titulo1,Titulo H1,texto\r\nsubtitulo1,Titulo H2,texto\r\npreguntacorreo,Pregunta para el correo,texto\r\nfrase1,Texto1,vartexto\r\nfrase2,Texto2,vartexto\r\ntextoemail,Texto para correo,texto\r\nemail,Email,email\r\nfacebook,Facebook,url\r\ntwitter,Twitter,url\r\nyoutube,Youtube,url\r\ntextotelefono,Texto para el telefono,texto\r\ntelefono,Telefono,telf'),(5,'venta dominio','Web de venta de un dominio','titulo,Titulo H1,texto\r\ntexto,Texto,vartexto\r\nprecio,Precio,numero'),(6,'Web2','pagina web2','texto1,Texto1,vartexto\r\ntexto2,Texto2,vartexto\r\ntexto3,Texto3,vartexto\r\ntextomas,Texto url,texto\r\nurlmas,Url mas informacion,url'),(7,'Web3','Plantilla Web3','texto1,Texto1,vartexto\r\ntexto2,Texto2,vartexto\r\ntexto3,Texto3,vartexto\r\nemail,Email,email\r\nfacebook,Facebook,url\r\ntwitter,Twitter,url\r\nlinkeding,Linkeding,url\r\ntelefono,Telefono,telf'),(8,'Wordpress','Blog de Wordpress','usuario_wp,Usuario wordpress,texto\r\ncontrasenya_wp,Contrase&ntilde;a,texto\r\nprefijo_wp,Prefijo de tablas (wp_),texto');
/*!40000 ALTER TABLE `tipopagina` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-02 11:51:28
