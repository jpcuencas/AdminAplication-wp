/*base de datos*/
USE gestionDominios;

/*Tabla servidores*/
DROP TABLE IF EXISTS servidor;
CREATE TABLE servidor (ID int auto_increment not null, 
	nombre VARCHAR(255),
	proveedor VARCHAR(255), 
	ip VARCHAR(20),
	usuario_web VARCHAR(255),
	contrasenya_web VARCHAR(255),
	servidor_ftp VARCHAR(255),
	usuario_ftp VARCHAR(255),
	contrasenya_ftp VARCHAR(255),
	primary key(ID)
);
/*
INSERT INTO `gestiondominios`.`servidor` (`ID`, `nombre`, `proveedor`, `ip`, `usuario_web`, `contrasenya_web`, `servidor_ftp`, `usuario_ftp`, `contrasenya_ftp`) VALUES (NULL, 'wwww','wwww', '1.1.1.1', 'www', 'wwww', 'wwww', 'wwww', 'wwww');
*/

/*tabla relacion servidor 1 -- * dominio*/
/*DROP TABLE IF EXISTS tieneDominios;
CREATE TABLE tieneDominios (
idServidor int not null,
idDominio int not null
);*/
/*
INSERT INTO `gestiondominios`.`tienedominios` (`idServidor`, `idDominio`) VALUES ('1', '1');
*/

/*Tabla dominios*/
DROP TABLE IF EXISTS dominio;
CREATE TABLE dominio (ID int auto_increment not null, 
	nombre VARCHAR(255),
	id_servidor int,
	id_tipo int,
	registro_en VARCHAR(255),
	valores LongText,
	idioma VARCHAR(255),
	id_plantilla VARCHAR(255),
	title VARCHAR(200),
	keywords text,
	descripcion text,
	estado char,
	primary key(ID)
);
/* TYPE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;*/
/*  TYPE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci; */
/*
INSERT INTO `gestiondominios`.`dominio` (`ID`, `nombre`, `id_servidor`, `id_tipo`, `registro_en`, `idioma`, `id_plantilla`, `estado`) VALUES (NULL, 'todoinstrumentos', '1', '1', 'wwww', 'wwwww', 'wwww', 'wwww');
*/

/*tabla relacion dominio * -- 1 tipo*/
/*DROP TABLE IF EXISTS tienetipos;
CREATE TABLE tieneTipos (
idDominio int not null,
idTipo int not null
);*/

/*
INSERT INTO `gestiondominios`.`tienetipos` (`idDominio`, `idTipo`) VALUES ('1', '1');
*/

/*Tabla tipos*/
DROP TABLE IF EXISTS tipopagina;
CREATE TABLE tipopagina (ID int auto_increment not null, 
	nombre VARCHAR(255),
	descripcion text,
	formato text,
	primary key(ID)
);

/*
INSERT INTO `gestiondominios`.`tipopagina` (`ID`, `nombre`, `descripcion`, `formato`) VALUES (NULL, 'blog', 'lkadfjj', 'lkadfjj');
*/

/*Tabla plantillas*/
DROP TABLE IF EXISTS plantilla;
CREATE TABLE plantilla (ID int auto_increment not null, 
	nombre VARCHAR(255),
	id_tipo int,
	descripcion text,
	prefijo varchar(255),
	primary key(ID)
);

/*
INSERT INTO `gestiondominios`.`plantilla` (`ID`, `nombre`, `descripcion`) VALUES (NULL, 'wordpress_basico_pt', 'plantilla en portugues');
*/

/*Tabla Idiomas*/
/*DROP TABLE IF EXISTS idoma;
CREATE TABLE Plantilla (codigo VARCHAR(255) auto_increment not null, 
	nombre VARCHAR(255),
	pais VARCHAR(255),
	primary key(codigo)
);*/

/*Tabla Plantillas*/
/*DROP TABLE IF EXISTS tipoPlantilla;
CREATE TABLE Plantilla (ID int auto_increment not null, 
	nombre VARCHAR(255),
	uri VARCHAR(255), 
	primary key(ID)
);*/