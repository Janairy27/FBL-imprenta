-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: imprenta
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acabado`
--

DROP TABLE IF EXISTS `acabado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acabado` (
  `idacabado` int(11) NOT NULL AUTO_INCREMENT,
  `nomAcabado` varchar(45) NOT NULL,
  PRIMARY KEY (`idacabado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acabado`
--

LOCK TABLES `acabado` WRITE;
/*!40000 ALTER TABLE `acabado` DISABLE KEYS */;
INSERT INTO `acabado` VALUES (1,'Suave'),(2,'Liso'),(3,'Brilloso'),(4,'No tiene'),(7,'Rugoso');
/*!40000 ALTER TABLE `acabado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baja`
--

DROP TABLE IF EXISTS `baja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baja` (
  `idbaja` int(11) NOT NULL AUTO_INCREMENT,
  `cantBaja` int(11) NOT NULL,
  `fechaBaja` date NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `idinsumos` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idbaja`),
  KEY `idinsumos` (`idinsumos`),
  KEY `idempleado` (`idempleado`),
  CONSTRAINT `baja_ibfk_1` FOREIGN KEY (`idinsumos`) REFERENCES `insumos` (`idinsumos`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `baja_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baja`
--

LOCK TABLES `baja` WRITE;
/*!40000 ALTER TABLE `baja` DISABLE KEYS */;
INSERT INTO `baja` VALUES (1,4,'2024-09-15','rotos',1,2),(2,1,'2024-09-20','Cuarteado',1,1),(3,1,'2024-11-09','Manchada',8,4);
/*!40000 ALTER TABLE `baja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `idcolor` int(11) NOT NULL AUTO_INCREMENT,
  `nomColor` varchar(255) NOT NULL,
  PRIMARY KEY (`idcolor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Azul'),(2,'Verde bandera'),(4,'Rosa'),(6,'Azul Rey'),(7,'Azul Marino');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle`
--

DROP TABLE IF EXISTS `detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle` (
  `folio` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `descuento` float NOT NULL,
  `subtotal` float NOT NULL,
  `iva` float NOT NULL,
  `total` float NOT NULL,
  `serie` int(11) DEFAULT NULL,
  PRIMARY KEY (`folio`),
  KEY `serie` (`serie`),
  CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`serie`) REFERENCES `pedido` (`serie`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle`
--

LOCK TABLES `detalle` WRITE;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
INSERT INTO `detalle` VALUES (0000000001,50,100,150,360,1),(0000000002,20,100,16,116,5);
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `nomb` varchar(45) NOT NULL,
  `apaterno` varchar(45) NOT NULL,
  `amaterno` varchar(45) DEFAULT NULL,
  `fecnaci` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Fernando','Bustamante','Leal','1970-08-26','Jiutepec','7772569841','fbustamante@prodigy.net.com','Representante','BUFE230J'),(2,'Leslie','Salinas','Rangel','2004-04-20','Yautepec','7356498750','lesliesalinas@gmail.com','Practicante','SALE204Y'),(3,'Joselin','Romaniz','lopez','0200-07-19','Jiutepec','7770236548','jromaniz@gmail.com','Empleado','ROJO456J'),(4,'Janairy','Sanchez','Vazquez','2002-12-27','Nispero 32 Jiutepec','7772345609','janairyalmon12@gmail.com','Practicante',NULL),(5,'Arturo','Perez','Beltran','2024-11-22','Roble 24 Jiutepec','7776212309','abeltran@prodygit.net.mx','Empleado',NULL),(6,'Arturo','Fernadez','Gonzales','1989-09-14','Cerano 23 Jiutepec','7774495131','arturo@gmail.com','Practicante',NULL);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Pendiente'),(2,'En Proceso'),(3,'En Proceso'),(4,'Completado'),(5,'Cancelado'),(6,'Retrasado'),(7,'Transportacion');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grosor`
--

DROP TABLE IF EXISTS `grosor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grosor` (
  `idgrosor` int(11) NOT NULL AUTO_INCREMENT,
  `cantGrosor` int(11) NOT NULL,
  `unidadMedida` varchar(45) NOT NULL,
  `flexibilidad` varchar(45) NOT NULL,
  PRIMARY KEY (`idgrosor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grosor`
--

LOCK TABLES `grosor` WRITE;
/*!40000 ALTER TABLE `grosor` DISABLE KEYS */;
INSERT INTO `grosor` VALUES (1,80,'Gramos','Flexible'),(2,90,'Puntos','Flexible'),(3,5,'mil','Flexible'),(4,0,'no tiene','Flexible');
/*!40000 ALTER TABLE `grosor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumoproducto`
--

DROP TABLE IF EXISTS `insumoproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insumoproducto` (
  `idinsumoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idproductoFinal` int(11) DEFAULT NULL,
  `idinsumos` int(11) DEFAULT NULL,
  `cantidadInsumo` float NOT NULL,
  `medidaProducto` float NOT NULL,
  PRIMARY KEY (`idinsumoProducto`),
  KEY `idproductoFinal` (`idproductoFinal`),
  KEY `idinsumos` (`idinsumos`),
  CONSTRAINT `insumoproducto_ibfk_1` FOREIGN KEY (`idproductoFinal`) REFERENCES `productoFinal` (`idproductoFinal`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumoproducto_ibfk_2` FOREIGN KEY (`idinsumos`) REFERENCES `insumos` (`idinsumos`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumoproducto`
--

LOCK TABLES `insumoproducto` WRITE;
/*!40000 ALTER TABLE `insumoproducto` DISABLE KEYS */;
INSERT INTO `insumoproducto` VALUES (2,8,1,2,15);
/*!40000 ALTER TABLE `insumoproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insumos` (
  `idinsumos` int(11) NOT NULL AUTO_INCREMENT,
  `nomInsumo` varchar(255) NOT NULL,
  `fechacompra` date NOT NULL,
  `fechauso` date DEFAULT NULL,
  `cantidad` float NOT NULL,
  `rendimiento` varchar(50) DEFAULT NULL,
  `precio` float NOT NULL,
  `disponibilidad` varchar(45) NOT NULL,
  `idubicacion` int(11) DEFAULT NULL,
  `idcolor` int(11) DEFAULT NULL,
  `idtransparencia` int(11) DEFAULT NULL,
  `idacabado` int(11) DEFAULT NULL,
  `idpresentacion` int(11) DEFAULT NULL,
  `idtipomedida` int(11) DEFAULT NULL,
  `idmedida` int(11) DEFAULT NULL,
  `idgrosor` int(11) DEFAULT NULL,
  `idmaterial` int(11) DEFAULT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idsubmaterial` int(11) DEFAULT NULL,
  PRIMARY KEY (`idinsumos`),
  KEY `idubicacion` (`idubicacion`),
  KEY `idcolor` (`idcolor`),
  KEY `idtransparencia` (`idtransparencia`),
  KEY `idacabado` (`idacabado`),
  KEY `idpresentacion` (`idpresentacion`),
  KEY `idtipomedida` (`idtipomedida`),
  KEY `idmedida` (`idmedida`),
  KEY `idgrosor` (`idgrosor`),
  KEY `idmaterial` (`idmaterial`),
  KEY `idproveedor` (`idproveedor`),
  KEY `idmarca` (`idmarca`),
  KEY `idsubmaterial` (`idsubmaterial`),
  CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`idubicacion`) REFERENCES `ubicacion` (`idubicacion`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_10` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_11` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_12` FOREIGN KEY (`idsubmaterial`) REFERENCES `submaterial` (`idsubmaterial`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_2` FOREIGN KEY (`idcolor`) REFERENCES `color` (`idcolor`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_3` FOREIGN KEY (`idtransparencia`) REFERENCES `transparencia` (`idtransparencia`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_4` FOREIGN KEY (`idacabado`) REFERENCES `acabado` (`idacabado`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_5` FOREIGN KEY (`idpresentacion`) REFERENCES `presentacion` (`idpresentacion`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_6` FOREIGN KEY (`idtipomedida`) REFERENCES `tipomedida` (`idtipomedida`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_7` FOREIGN KEY (`idmedida`) REFERENCES `medida` (`idmedida`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_8` FOREIGN KEY (`idgrosor`) REFERENCES `grosor` (`idgrosor`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `insumos_ibfk_9` FOREIGN KEY (`idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumos`
--

LOCK TABLES `insumos` WRITE;
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` VALUES (1,'Pluma','2002-02-12','2013-11-23',4,'cinco',56,'disponible',1,1,1,1,1,1,1,1,1,1,1,1),(3,'Tubo para pluma','2021-12-21','2024-11-04',22,'23',15,'Disponible',2,1,1,2,2,1,1,2,1,1,2,1),(7,'Material para enmicar','2024-11-14','2024-11-23',23,'23',1000,'Disponible',7,7,1,1,1,1,6,3,4,3,2,3),(8,'Playera','2024-11-01','2024-11-23',12,'13',100,'Disponible',9,6,3,1,2,3,4,4,6,2,5,1);
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nomMarca` varchar(45) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Scribe','Herramienta de papeleria'),(2,'Ecoflex','Fabricacion de plasticos'),(4,'Shiny','Cracion de sellos'),(5,'Yazbeck','Playeras');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `nomMaterial` varchar(45) NOT NULL,
  PRIMARY KEY (`idmaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Papel sublimacion'),(2,'Curly'),(3,'Kraft'),(4,'Plastico'),(5,'No existe'),(6,'Tela');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medida`
--

DROP TABLE IF EXISTS `medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
  `largo` float NOT NULL,
  `ancho` float NOT NULL,
  PRIMARY KEY (`idmedida`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
INSERT INTO `medida` VALUES (1,21.59,27.94),(2,12.6,43.7),(3,34.5,14.6),(4,0,0),(6,23.4,12.3);
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `serie` int(11) NOT NULL AUTO_INCREMENT,
  `cant` int(11) NOT NULL,
  `nombrecliente` varchar(45) NOT NULL,
  `fechaPedido` date NOT NULL,
  `idproductoFinal` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `idestado` int(11) DEFAULT NULL,
  PRIMARY KEY (`serie`),
  KEY `idproductoFinal` (`idproductoFinal`),
  KEY `idempleado` (`idempleado`),
  KEY `idestado` (`idestado`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idproductoFinal`) REFERENCES `productoFinal` (`idproductoFinal`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (1,4,'Juan Lopez','2024-11-05',2,3,1),(3,6,'Ana Flores','2024-11-29',3,3,2),(5,5,'Luisa Hernadez','2024-11-18',5,4,1);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentacion`
--

DROP TABLE IF EXISTS `presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentacion` (
  `idpresentacion` int(11) NOT NULL AUTO_INCREMENT,
  `nomPresentacion` varchar(255) NOT NULL,
  PRIMARY KEY (`idpresentacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentacion`
--

LOCK TABLES `presentacion` WRITE;
/*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;
INSERT INTO `presentacion` VALUES (1,'Rollo'),(2,'Pza'),(3,'Paquete'),(4,'No tiene'),(5,'hojas'),(6,'Botes');
/*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productoFinal`
--

DROP TABLE IF EXISTS `productoFinal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productoFinal` (
  `idproductoFinal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`idproductoFinal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productoFinal`
--

LOCK TABLES `productoFinal` WRITE;
/*!40000 ALTER TABLE `productoFinal` DISABLE KEYS */;
INSERT INTO `productoFinal` VALUES (1,'Playera con estampado pequeño',100),(2,'Collar para gafete',50),(3,'Tarjetas de 15 años',30),(4,'Taza sublimada',200),(5,'Playera sublimada',150),(8,'Pluma decorada',30);
/*!40000 ALTER TABLE `productoFinal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `Nomproveedor` varchar(45) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `NoCliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Sams Club','Jiutepec','Luis Fernandez','7774495131','luis@samsclub.com',23),(2,'Liverpool','Cuernavaca','Adrian Silva','7770912321','adrian@liverpool.com',43),(3,'Peleteria la continetal','Cuernavaca','Ivan Flores','5554321185','ivanflores@gmail.com',12),(4,'Office Max','Ciudad de Mexico','Juan Perez','7772312345','juan@gmail.com',45),(5,'Home depot','Jiutepec','Fernando Juarez','7772367211','fernando@homedepot.com',121);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submaterial`
--

DROP TABLE IF EXISTS `submaterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submaterial` (
  `idsubmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `nomSubmaterial` varchar(45) NOT NULL,
  PRIMARY KEY (`idsubmaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submaterial`
--

LOCK TABLES `submaterial` WRITE;
/*!40000 ALTER TABLE `submaterial` DISABLE KEYS */;
INSERT INTO `submaterial` VALUES (1,'Poliester'),(2,'Pla'),(3,'No existe'),(4,'algodon');
/*!40000 ALTER TABLE `submaterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipomedida`
--

DROP TABLE IF EXISTS `tipomedida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipomedida` (
  `idtipomedida` int(11) NOT NULL AUTO_INCREMENT,
  `nomTipomedida` varchar(45) NOT NULL,
  `unidad` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipomedida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipomedida`
--

LOCK TABLES `tipomedida` WRITE;
/*!40000 ALTER TABLE `tipomedida` DISABLE KEYS */;
INSERT INTO `tipomedida` VALUES (1,'Lineal','cm'),(2,'Area','m'),(3,'No tiene','No tiene');
/*!40000 ALTER TABLE `tipomedida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transparencia`
--

DROP TABLE IF EXISTS `transparencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transparencia` (
  `idtransparencia` int(11) NOT NULL AUTO_INCREMENT,
  `nomTransparencia` varchar(45) NOT NULL,
  PRIMARY KEY (`idtransparencia`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transparencia`
--

LOCK TABLES `transparencia` WRITE;
/*!40000 ALTER TABLE `transparencia` DISABLE KEYS */;
INSERT INTO `transparencia` VALUES (1,'Translucido'),(3,'No existe'),(4,'Transparente'),(9,'Opal');
/*!40000 ALTER TABLE `transparencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubicacion` (
  `idubicacion` int(11) NOT NULL AUTO_INCREMENT,
  `mueble` varchar(60) NOT NULL,
  `division1` varchar(60) NOT NULL,
  `division2` varchar(60) DEFAULT NULL,
  `division3` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubicacion`
--

LOCK TABLES `ubicacion` WRITE;
/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
INSERT INTO `ubicacion` VALUES (1,'Estante 8','Entrepaño 3','Bote 12','Bolsa 0'),(2,'Estante 11','Entrepaño 3','Bote 0','Bolsa 0'),(3,'Mesa 2','Cajon 3','Caja 0','Bolsa 0'),(4,'Cajonera 1','Caja 2','Caja 1','Bolsa 0'),(5,'Estante 11','Entrepaño 3','Bote 2','Bolsa 0'),(6,'Mesa 4','Cajon 10','Caja 0','Bolsa 0'),(7,'Mesa 2','Cajon 4','Caja 0','Bolsa 0'),(8,'Mesa 5','Cajon 12','Caja 0','Bolsa 0'),(9,'Estante 9','Entrpaño 3','Bote 3','Bolsa 0');
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `idempleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`),
  KEY `idempleado` (`idempleado`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'FERBUS70','BUFE230J',1),(2,'LESSAL04','SALE204Y',2),(3,'JOSROM00','ROJO456J',3),(4,'JANSAN20','janairy27',4);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-25  7:19:07
