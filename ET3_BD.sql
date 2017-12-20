-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2017 at 10:08 AM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IUET32017`
--
-- jrodeiro - 7/10/2017
-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `IUET32017`;
CREATE DATABASE `IUET32017` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `IUET32017`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `userET3`@`localhost`;
	DROP USER `userET3`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `userET3`@`localhost` IDENTIFIED BY 'passET3';
GRANT USAGE ON *.* TO `userET3`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `IUET32017`.* TO `userET3`@`localhost` WITH GRANT OPTION;
-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Table structure for table `PERMISO`
--

CREATE TABLE `PERMISO` (
  `IdGrupo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,  
  `IdFuncionalidad` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `IdAccion` varchar(6) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Table structure for table `FUNC_ACCION`
--

CREATE TABLE `FUNC_ACCION` (
  `IdFuncionalidad` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `IdAccion` varchar(6) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


--
-- Table structure for table `USUARIO_GRUPO`
--

CREATE TABLE `USU_GRUPO` (
  `login` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `IdGrupo` varchar(6) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Table structure for table `ACCION`
--

CREATE TABLE `ACCION` (
  `IdAccion` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NombreAccion` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `DescripAccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FUNCIONALIDAD`
--

CREATE TABLE `FUNCIONALIDAD` (
  `IdFuncionalidad` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NombreFuncionalidad` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `DescripFuncionalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------
--
-- Table structure for table `GRUPO`
--

CREATE TABLE `GRUPO` (
  `IdGrupo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NombreGrupo` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `DescripGrupo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TRABAJO`
--

CREATE TABLE `TRABAJO` (
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NombreTrabajo` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `FechaIniTrabajo` date NOT NULL,
  `FechaFinTrabajo` date NOT NULL,
  `PorcentajeNota` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `EVALUACION`
--
-- OK : indicación de si esta correcta o no la QA (1 correcto, 0 Incorrecto)
-- CorrectoP : Indicación de si esta correcta la historia de la ET
-- CorrectoA : evaluación de la historia por parte del alumno evaluador de esa historia de esa ET

CREATE TABLE `EVALUACION` (
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `LoginEvaluador` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `AliasEvaluado` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `IdHistoria` int(2) NOT NULL,
  `CorrectoA` tinyint(1) NOT NULL,
  `ComenIncorrectoA` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `CorrectoP` tinyint(1) NOT NULL,
  `ComentIncorrectoP` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `OK` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HISTORIA`
--

CREATE TABLE `HISTORIA` (
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `IdHistoria` int(2) NOT NULL,
  `TextoHistoria` varchar(300) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `NOTASTRABAJO`
--

CREATE TABLE `NOTA_TRABAJO` (
  `login` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NotaTrabajo` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `QA`
--

CREATE TABLE `ASIGNAC_QA` (
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `LoginEvaluador` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `LoginEvaluado` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `AliasEvaluado` varchar(6) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ENTREGA`
--

CREATE TABLE `ENTREGA` (
  `login` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `IdTrabajo` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `Alias` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Horas` int(2) DEFAULT NULL,
  `Ruta` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `USUARIO`
--

CREATE TABLE `USUARIO` (
  `login` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE latin1_spanish_ci NOT NULL,
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Apellidos` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Correo` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `Direccion` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `Telefono` varchar(11) COLLATE latin1_spanish_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Indexes for table `TRABAJO`
--
ALTER TABLE `TRABAJO`
  ADD PRIMARY KEY (`IdTrabajo`);

--
-- Indexes for table `EVALUACION`
--
ALTER TABLE `EVALUACION`
  ADD PRIMARY KEY (`IdTrabajo`,`AliasEvaluado`,`LoginEvaluador`,`IdHistoria`);

--
-- Indexes for table `HISTORIA`
--
ALTER TABLE `HISTORIA`
  ADD PRIMARY KEY (`IdTrabajo`,`IdHistoria`);

--
-- Indexes for table `NOTASTRABAJO`
--
ALTER TABLE `NOTA_TRABAJO`
  ADD PRIMARY KEY (`login`,`IdTrabajo`);

--
-- Indexes for table `QA`
--
ALTER TABLE `ASIGNAC_QA`
  ADD PRIMARY KEY (`IdTrabajo`,`LoginEvaluador`,`AliasEvaluado`);

--
-- Indexes for table `ENTREGA`
--
ALTER TABLE `ENTREGA`
  ADD PRIMARY KEY (`login`,`IdTrabajo`);

--
-- Indexes for table `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`login`);

--
-- Indexes for table `GRUPO`
--
ALTER TABLE `GRUPO`
  ADD PRIMARY KEY (`IdGrupo`);

--
-- Indexes for table `FUNCIONALIDAD`
--
ALTER TABLE `FUNCIONALIDAD`
  ADD PRIMARY KEY (`IdFuncionalidad`);

--
-- Indexes for table `ACCION`
--
ALTER TABLE `ACCION`
  ADD PRIMARY KEY (`IdAccion`);

--
-- Indexes for table `USUARIO_GRUPO`
--
ALTER TABLE `USU_GRUPO`
  ADD PRIMARY KEY (`login`,`IdGrupo`);

--
-- Indexes for table `FUNC_ACCION`
--
ALTER TABLE `FUNC_ACCION`
  ADD PRIMARY KEY (`IdFuncionalidad`,`IdAccion`);

--
-- Indexes for table `PERMISO`
--
ALTER TABLE `PERMISO`
  ADD PRIMARY KEY (`IdGrupo`,`IdFuncionalidad`,`IdAccion`);


  INSERT INTO USUARIO(login,password, DNI,Nombre,Apellidos,Telefono,Correo,Direccion)   
                              VALUES  ('admin','21232f297a57a5a743894a0e4a801fc3','30199743F','Pepe','Rodriguez Sanchez','679889767','admin@gmail.com','Ourense'),
                                  ('user','ee11cbb19052e40b07aac0ca060c23ee','20449860P','Carlos','Perez Nunez','671806776','user@gmail.com','Celanova'),
                                  ('juan','a94652aa97c7211ba8954dd15a3cf838', '79149090H','Juan','Vazquez Perez','674566982', 'juan@gmail.com','Ourense'),
                                  ('pablo','7e4b64eb65e34fdfad79e623c44abd94','15428244M','Pablo','Mazaira Viso','671913475', 'pablo@gmail.com','Ourense'),
                                  ('raul','bc7a844476607e1a59d8eb1b1f311830', '89524943L','Raul', 'Fuentes Lopez','676166982', 'raul@gmail.com','Ourense'),
                                  ('marta','a763a66f984948ca463b081bf0f0e6d0','34264616K','Marta','Castro Valero','674560382', 'marta@gmail.com','Ourense');
                                  
INSERT INTO `GRUPO`(`IdGrupo`, `NombreGrupo`, `DescripGrupo`) VALUES  ('ADMIN','Administradores','Grupo formado por los administradores de la web'),
                                    ('ALUMNO','Alumnos','Grupo formado por los alumnos de IU');


INSERT INTO `ACCION`(`IdAccion`, `NombreAccion`, `DescripAccion`) VALUES  ('ADD','Anadir','Permite anadir'),
                                      ('EDIT','Modificar','Permite modificar'),
                                      ('SHOW','Mostrar Detalle','Muestra en detalle'),
                                      ('DELETE','Eliminar','Permite eliminar'),
                                      ('SEARCH','Buscar','Permite buscar'),
                                      ('ALL','Mostrar Todo','Permite mostrar todos'),
                                      ('ASIG','Asignar','Permite asignar'),
                                      ('GENEV','Generar Evaluaciones','Permite generar Evaluaciones'),
                                      ('GENQA','Generar QA','Permite generar QAs'),
                                      ('ADDAL', 'Anadir Entrega', 'Permite anadir entrega'),
                                      ('CALIF', 'Calificar', 'Permite calificar Evaluaciones'),
                                      ('SHOWH', 'Mostrar Historias', 'Mostrar historias de un trabajo'),
                                      ('RESULT', 'Resultados QA', 'Mostrar resultados de una QA'),
                                      ('GENNOT', 'Generar Notas', 'Generar Notas');

INSERT INTO `FUNCIONALIDAD` (`IdFuncionalidad`, `NombreFuncionalidad`, `DescripFuncionalidad`)
                                VALUES  (1, 'Gestion Usuarios', 'Funcionalidad que permite realizar una gestion de usuarios'),
                                    (2, 'Gestion Grupos', 'Funcionalidad que permite realizar una gestion de grupos'),
                                    (3, 'Gestion Funcionalidades', 'Funcionalidad que permite realizar una gestion de funcionalidades'),
                                    (4, 'Gestion Acciones', 'Funcionalidad que permite realizar una gestion de acciones'),
                                    (5, 'Gestion Permisos', 'Funcionalidad que permite realizar una gestion de permisos'),
                                    (6, 'Gestion Trabajos', 'Funcionalidad que permite realizar una gestion de trabajos'),
                                    (7, 'Gestion Historias', 'Funcionalidad que permite realizar una gestion de historias'),
                                    (8, 'Gestion Entregas', 'Funcionalidad que permite realizar una gestion de entregas'),
                                    (9, 'Gestion Asignacion QAs', 'Funcionalidad que permite realizar una gestion de asignacion de QAs'),
                                    (10, 'Gestion Evaluaciones', 'Funcionalidad que permite realizar una gestion de evaluaciones'),
                                    (11, 'Gestion Notas', 'Funcionalidad que permite realizar una gestion de notas');


INSERT INTO `FUNC_ACCION` (`IdFuncionalidad`, `IdAccion`) VALUES  (1, 'ADD'), (1, 'EDIT'), (1, 'SEARCH'), (1, 'DELETE'), (1, 'ALL'), (1, 'SHOW'), (1, 'ASIG'), 
                                  (2, 'ADD'), (2, 'EDIT'), (2, 'SEARCH'), (2, 'DELETE'), (2, 'ALL'), (2, 'SHOW'), (2, 'ASIG'), 
                                  (3, 'ADD'), (3, 'EDIT'), (3, 'SEARCH'), (3, 'DELETE'), (3, 'ALL'), (3, 'SHOW'), (3, 'ASIG'), 
                                  (4, 'ADD'), (4, 'EDIT'), (4, 'SEARCH'), (4, 'DELETE'), (4, 'ALL'), (4, 'SHOW'), 
                                  (5, 'SEARCH'),(5, 'ALL'),
                                  (6, 'ADD'), (6, 'EDIT'), (6, 'SEARCH'), (6, 'DELETE'), (6, 'ALL'), (6, 'SHOW'), 
                                  (7, 'ADD'), (7, 'EDIT'), (7, 'SEARCH'), (7, 'DELETE'), (7, 'ALL'), (7, 'SHOW'), (7,'SHOWH'),
                                  (8, 'ADD'), (8, 'EDIT'), (8, 'SEARCH'), (8, 'DELETE'), (8, 'ALL'), (8, 'SHOW'), (8,'ADDAL'),
                                  (9, 'ADD'), (9, 'EDIT'), (9, 'SEARCH'), (9, 'DELETE'), (9, 'ALL'), (9, 'SHOW'), (9, 'GENQA'),(9, 'GENEV'),
                                  (10, 'ADD'), (10, 'EDIT'), (10, 'SEARCH'), (10, 'DELETE'), (10, 'ALL'), (10, 'SHOW'), (10,'CALIF'),(11,'RESUL'),
                                  (11, 'ADD'), (11, 'EDIT'), (11, 'SEARCH'), (11, 'DELETE'), (11, 'ALL'), (11, 'SHOW'), (11,'GENNOT');

                                  
INSERT INTO `USU_GRUPO` (`login`, `IdGrupo`) VALUES ('admin', 'ADMIN'), ('user', 'ALUMNO'),('pablo','ALUMNO'),('lucia','ALUMNO'),('juan','ALUMNO'),('marta','ALUMNO'),('raul','ALUMNO');

INSERT INTO `PERMISO`(`IdGrupo`,`IdFuncionalidad`,`IdAccion`) VALUES  ('ADMIN',1,'ADD'),('ADMIN',1,'EDIT'),('ADMIN',1,'SHOW'),('ADMIN',1,'DELETE'), ('ADMIN',1,'SEARCH'),('ADMIN',1,'ALL'), ('ADMIN',1,'ASIG'),
                                    ('ADMIN',2,'ADD'),('ADMIN',2,'EDIT'),('ADMIN',2,'SHOW'),('ADMIN',2,'DELETE'), ('ADMIN',2,'SEARCH'),('ADMIN',2,'ALL'), ('ADMIN',2,'ASIG'),
                                    ('ADMIN',3,'ADD'),('ADMIN',3,'EDIT'),('ADMIN',3,'SHOW'),('ADMIN',3,'DELETE'), ('ADMIN',3,'SEARCH'),('ADMIN',3,'ALL'), ('ADMIN',3,'ASIG'),
                                    ('ADMIN',4,'ADD'),('ADMIN',4,'EDIT'),('ADMIN',4,'SHOW'),('ADMIN',4,'DELETE'), ('ADMIN',4,'SEARCH'),('ADMIN',4,'ALL'),
                                    ('ADMIN',5,'SEARCH'),('ADMIN',5,'ALL'),
                                    ('ADMIN',6,'ADD'),('ADMIN',6,'EDIT'),('ADMIN',6,'SHOW'),('ADMIN',6,'DELETE'), ('ADMIN',6,'SEARCH'),('ADMIN',6,'ALL'),
                                    ('ADMIN',7,'ADD'),('ADMIN',7,'EDIT'),('ADMIN',7,'SHOW'),('ADMIN',7,'DELETE'), ('ADMIN',7,'SEARCH'),('ADMIN',7,'ALL'),('ADMIN',7,'SHOWH'),
                                    ('ADMIN',8,'ADD'),('ADMIN',8,'EDIT'),('ADMIN',8,'SHOW'),('ADMIN',8,'DELETE'), ('ADMIN',8,'SEARCH'),('ADMIN',8,'ALL'),
                                    ('ADMIN',9,'ADD'),('ADMIN',9,'EDIT'),('ADMIN',9,'SHOW'),('ADMIN',9,'DELETE'), ('ADMIN',9,'SEARCH'),('ADMIN',9,'ALL'),('ADMIN',9, 'GENQA'),('ADMIN',9, 'GENEV'),
                                    ('ADMIN',10,'ADD'),('ADMIN',10,'SHOW'),('ADMIN',10,'DELETE'), ('ADMIN',10,'SEARCH'),('ADMIN',10,'ALL'),('ADMIN',10, 'CALIF'),('ADMIN',10, 'EDIT'),('ADMIN',11, 'RESUL'),
                                    ('ADMIN',11,'ADD'),('ADMIN',11,'EDIT'),('ADMIN',11,'SHOW'),('ADMIN',11,'DELETE'), ('ADMIN',11,'SEARCH'),('ADMIN',11,'ALL'),('ADMIN',11,'GENNOT'),
                                    ('ALUMNO',6,'SHOW'),
                                    ('ALUMNO',8,'EDIT'),('ALUMNO',8,'SHOW'),('ALUMNO',8,'ADDAL'),
                                    ('ALUMNO',10,'EDIT'),('ALUMNO',10,'SHOW'),('ALUMNO',10, 'RESUL'),
                                    ('ALUMNO',11,'SHOW');

INSERT INTO `TRABAJO` ( `IdTrabajo`, `NombreTrabajo`, `FechaIniTrabajo`, `FechaFinTrabajo` , `PorcentajeNota`)
                                VALUES  ('ET1', 'Trabajo de Formularios', '2017-09-05', '2017-09-15', 25),
                                    ('ET2', 'Trabajo de Pagina Web', '2017-09-25', '2017-10-05', 23),
                                    ('ET3', 'Trabajo en Equipo', '2017-10-15', '2017-10-25', 31),
                                    ('QA1', 'QA de ET1', '2017-9-15', '2017-9-25', 7),
                                    ('QA2', 'QA de ET2', '2017-10-05', '2017-10-15', 7),
                                    ('QA3', 'QA de ET3', '2017-10-25', '2017-10-25', 7);
                                    
                                    
INSERT INTO `HISTORIA` ( `IdTrabajo`, `IdHistoria`, `TextoHistoria`) 
                  VALUES  ('ET1', 01, 'El diseno sigue la estructura solicitada'),
                      ('ET1', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('ET1', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('ET1', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('ET1', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('ET2', 01, 'El diseno sigue la estructura solicitada'),
                      ('ET2', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('ET2', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('ET2', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('ET2', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('ET2', 06, 'Realiza correctamente insercciones en la BD'),
                      ('ET2', 07, 'No se envia información al navegador desde el modelo de datos'),
                      ('ET3', 01, 'El diseno sigue la estructura solicitada'),
                      ('ET3', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('ET3', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('ET3', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('ET3', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('ET3', 06, 'Realiza correctamente insercciones en la BD'),
                      ('ET3', 07, 'No se envia información al navegador desde el modelo de datos'),
                      ('ET3', 08, 'Tiene ACL'),
                      ('ET3', 09, 'Quita los iconos cuando no hay permisos'),                                 
                      ('QA1', 01, 'El diseno sigue la estructura solicitada'),
                      ('QA1', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('QA1', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('QA1', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('QA1', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('QA2', 01, 'El diseno sigue la estructura solicitada'),
                      ('QA2', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('QA2', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('QA2', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('QA2', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('QA2', 06, 'Realiza correctamente insercciones en la BD'),
                      ('QA2', 07, 'No se envia información al navegador desde el modelo de datos'),
                      ('QA3', 01, 'El diseno sigue la estructura solicitada'),
                      ('QA3', 02, 'El diseno tiene todos los elementos solicitados'),
                      ('QA3', 03, 'El diseno mantiene coherencia visual entre los elementos de la página'),
                      ('QA3', 04, 'El diseno de los formularios es coherente entre los mismos'),
                      ('QA3', 05, 'El diseno de las tablas de muestra de datos es coherente entre las tablas'),
                      ('QA3', 06, 'Realiza correctamente insercciones en la BD'),
                      ('QA3', 07, 'No se envia información al navegador desde el modelo de datos'),
                      ('QA3', 08, 'Tiene ACL');


INSERT INTO `ENTREGA`(`login`, `IdTrabajo`, `Alias`, `Horas`, `Ruta`)
                                VALUES  ('user', 'ET1', 'asdfgh', '0',''),
                                    ('juan', 'ET1', 'zxcvbn', '0',''),
                                    ('marta', 'ET1', 'poiuyt', '0',''),
                                    ('pablo', 'ET1', 'mnbvcx', '0',''),
                                    ('raul', 'ET1', 'lkjhgf', '0','');    

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
