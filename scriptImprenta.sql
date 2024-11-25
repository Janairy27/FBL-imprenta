drop database if exists imprenta;
create database imprenta;
use imprenta;
 
CREATE TABLE `imprenta`.`ubicacion` (
  `idubicacion` INT NOT NULL auto_increment,
  `mueble` varchar(60) NOT NULL,
  `division1` varchar(60) NOT NULL,
  `division2` varchar(60) NULL,
  `division3` varchar(60) NULL,
  PRIMARY KEY (`idubicacion`));
    
CREATE TABLE `imprenta`.`marca` (
	`idmarca` INT NOT NULL auto_increment,
	`nomMarca` VARCHAR(45) NOT NULL,
    `descripcion` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`idmarca`));

CREATE TABLE `imprenta`.`color` (
  `idcolor` INT NOT NULL auto_increment,
  `nomColor` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idcolor`));
  
  CREATE TABLE `imprenta`.`transparencia` (
  `idtransparencia` INT NOT NULL auto_increment,
  `nomTransparencia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtransparencia`));
  
  CREATE TABLE `imprenta`.`acabado` (
  `idacabado` INT NOT NULL AUTO_INCREMENT,
  `nomAcabado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idacabado`));
  
  CREATE TABLE `imprenta`.`tipomedida` (
  `idtipomedida` INT NOT NULL auto_increment,
  `nomTipomedida` VARCHAR(45) NOT NULL,
  `unidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipomedida`));

CREATE TABLE `imprenta`.`material` (
  `idmaterial` INT NOT NULL auto_increment,
  `nomMaterial` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmaterial`));

CREATE TABLE `imprenta`.`submaterial` (
  `idsubmaterial` INT NOT NULL auto_increment,
  `nomSubmaterial` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idsubmaterial`));
  
  CREATE TABLE `imprenta`.`grosor` (
  `idgrosor` INT NOT NULL auto_increment,
  `cantGrosor` int NOT NULL,
  `unidadMedida` VARCHAR(45) NOT NULL,
  `flexibilidad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idgrosor`));

CREATE TABLE `imprenta`.`medida` (
  `idmedida` INT NOT NULL auto_increment,
  `largo` FLOAT NOT NULL,
  `ancho` FLOAT NOT NULL,
  PRIMARY KEY (`idmedida`));
  
  CREATE TABLE `imprenta`.`presentacion` (
  `idpresentacion` INT NOT NULL auto_increment,
  `nomPresentacion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idpresentacion`));

CREATE TABLE `imprenta`.`proveedor` (
  `idproveedor` INT NOT NULL auto_increment,
  `Nomproveedor` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(255) NULL,
  `contacto` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `NoCliente` INT NULL,
  PRIMARY KEY (`idproveedor`));

CREATE TABLE `imprenta`.`insumos` (
  `idinsumos` INT NOT NULL auto_increment,
  `nomInsumo` VARCHAR(255) NOT NULL,
  `fechacompra` DATE NOT NULL,
  `fechauso` DATE NULL,
  `cantidad` FLOAT NOT NULL,
  `rendimiento` VARCHAR(50) NULL,
  `precio` FLOAT NOT NULL,
  `disponibilidad` VARCHAR(45) NOT NULL,
  `idubicacion` INT NULL,
  `idcolor` INT NULL,
  `idtransparencia` INT NULL,
  `idacabado` INT NULL,
  `idpresentacion` INT NULL,
  `idtipomedida` INT NULL,
  `idmedida` INT NULL,
  `idgrosor` INT NULL,
  `idmaterial` INT NULL,
  `idproveedor` INT NULL,
  `idmarca` INT NULL,
  `idsubmaterial` INT NULL,
  PRIMARY KEY (`idinsumos`),
    FOREIGN KEY (`idubicacion`)
    REFERENCES `imprenta`.`ubicacion` (`idubicacion`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idcolor`)
    REFERENCES `imprenta`.`color` (`idcolor`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idtransparencia`)
    REFERENCES `imprenta`.`transparencia` (`idtransparencia`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idacabado`)
    REFERENCES `imprenta`.`acabado` (`idacabado`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idpresentacion`)
    REFERENCES `imprenta`.`presentacion` (`idpresentacion`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idtipomedida`)
    REFERENCES `imprenta`.`tipomedida` (`idtipomedida`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idmedida`)
    REFERENCES `imprenta`.`medida` (`idmedida`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idgrosor`)
    REFERENCES `imprenta`.`grosor` (`idgrosor`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idmaterial`)
    REFERENCES `imprenta`.`material` (`idmaterial`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idproveedor`)
    REFERENCES `imprenta`.`proveedor` (`idproveedor`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idmarca`)
    REFERENCES `imprenta`.`marca` (`idmarca`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idsubmaterial`)
    REFERENCES `imprenta`.`submaterial` (`idsubmaterial`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);

  
 CREATE TABLE imprenta.empleado (
  idempleado INT auto_increment NOT NULL,
  nomb VARCHAR(45) NOT NULL,
  apaterno VARCHAR(45) NOT NULL,
  amaterno VARCHAR(45) NULL,
  fecnaci DATE NOT NULL,
  direccion VARCHAR(45) NOT NULL,
  telefono VARCHAR(45) NOT NULL,
  correo VARCHAR(45) NOT NULL,
  rol varchar(45) not null,
  codigo VARCHAR(45) NULL,
  PRIMARY KEY (idempleado));
  
CREATE TABLE `imprenta`.`usuarios` (
  `idusuarios` INT NOT NULL auto_increment,
  `usuario` VARCHAR(45) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `idempleado` INT NULL,
  PRIMARY KEY (`idusuarios`),
    FOREIGN KEY (`idempleado`)
    REFERENCES `imprenta`.`empleado` (`idempleado`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);
    
  

CREATE TABLE `imprenta`.`baja` (
  `idbaja` INT NOT NULL auto_increment,
  `cantBaja` INT NOT NULL,
  `fechaBaja` DATE NOT NULL,
  `motivo` VARCHAR(255) NOT NULL,
  `idinsumos` INT NULL,
  `idempleado` INT NULL,
  PRIMARY KEY (`idbaja`),
    FOREIGN KEY (`idinsumos`)
    REFERENCES `imprenta`.`insumos` (`idinsumos`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idempleado`)
    REFERENCES `imprenta`.`empleado` (`idempleado`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);

CREATE TABLE `imprenta`.`estado` (
  `idestado` INT NOT NULL auto_increment,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestado`));
  
CREATE TABLE `imprenta`.`productoFinal` (
  `idproductoFinal` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `precio` FLOAT NOT NULL,
  PRIMARY KEY (`idproductoFinal`));
  
CREATE TABLE `imprenta`.`pedido` (
  `serie` INT NOT NULL auto_increment,
  `cant` INT NOT NULL,
  `nombrecliente` VARCHAR(45) NOT NULL,
  `fechaPedido` DATE NOT NULL,
  `idproductoFinal` INT NULL,
  `idempleado` INT NULL,
  `idestado` INT NULL,
  PRIMARY KEY (`serie`),
    FOREIGN KEY (`idproductoFinal`)
    REFERENCES `imprenta`.`productoFinal` (`idproductoFinal`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idempleado`)
    REFERENCES `imprenta`.`empleado` (`idempleado`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idestado`)
    REFERENCES `imprenta`.`estado` (`idestado`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);
    

CREATE TABLE `imprenta`.`detalle` (
  `folio` INT ZEROFILL NOT NULL AUTO_INCREMENT,
  `descuento` FLOAT NOT NULL,
  `subtotal` FLOAT NOT NULL,
  `iva` FLOAT NOT NULL,
  `total` FLOAT NOT NULL,
  `serie` INT NULL,
  PRIMARY KEY (`folio`),
    FOREIGN KEY (`serie`)
    REFERENCES `imprenta`.`pedido` (`serie`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);
  

CREATE TABLE `imprenta`.`insumoproducto` (
  `idinsumoProducto` INT NOT NULL AUTO_INCREMENT,
  `idproductoFinal` INT NULL,
  `idinsumos` INT NULL,
  `cantidadInsumo` FLOAT NOT NULL,
  `medidaProducto` FLOAT NOT NULL,
  PRIMARY KEY (`idinsumoProducto`),
    FOREIGN KEY (`idproductoFinal`)
    REFERENCES `imprenta`.`productoFinal` (`idproductoFinal`)
    ON DELETE CASCADE
    ON UPDATE SET NULL,
    FOREIGN KEY (`idinsumos`)
    REFERENCES `imprenta`.`insumos` (`idinsumos`)
    ON DELETE CASCADE
    ON UPDATE SET NULL);

 

INSERT INTO `ubicacion` VALUES (1,'Estante 8','Entrepaño 3','Bote 12','Bolsa 0'),(2,'Estante 11','Entrepaño 3','Bote 0','Bolsa 0'),(3,'Mesa 2','Cajon 3','Caja 0','Bolsa 0'),(4,'Cajonera 1','Caja 2','Caja 1','Bolsa 0'),(5,'Estante 11','Entrepaño 3','Bote 2','Bolsa 0'),(6,'Mesa 4','Cajon 10','Caja 0','Bolsa 0'),(7,'Mesa 2','Cajon 4','Caja 0','Bolsa 0'),(8,'Mesa 5','Cajon 12','Caja 0','Bolsa 0');
INSERT INTO `marca` VALUES (1,'Scribe','Herramienta de papeleria'),(2,'Ecoflex','Fabricacion de plasticos'),(4,'Shiny','Cracion de sellos'),(5,'Yazbeck','Playeras');
INSERT INTO `color` VALUES (1,'Azul'),(2,'Verde bandera'),(4,'Rosa'),(6,'Azul Rey'),(7,'Azul Marino');
INSERT INTO `transparencia` VALUES (1,'Translucido'),(3,'No existe'),(4,'Transparente'),(9,'Opal');
INSERT INTO `acabado` VALUES (1,'Suave'),(2,'Liso'),(3,'Brilloso'),(4,'No tiene'),(7,'Rugoso');
INSERT INTO `tipomedida` VALUES (1,'Lineal','cm'),(2,'Area','m');
INSERT INTO `material` VALUES (1,'Papel sublimacion'),(2,'Curly'),(3,'Kraft'),(4,'Plastico'),(5,'No existe'),(6,'Tela');
INSERT INTO `submaterial` VALUES (1,'Poliester'),(2,'Pla'),(3,'No existe'),(4,'algodon');
INSERT INTO `grosor` VALUES (1,80,'Gramos','Flexible'),(2,90,'Puntos','Flexible'),(3,5,'mil','Flexible');
INSERT INTO `medida` VALUES (1,21.59,27.94),(2,12.6,43.7),(3,34.5,14.6),(4,0,0),(6,23.4,12.3);
INSERT INTO `presentacion` VALUES (1,'Rollo'),(2,'Pza'),(3,'Paquete'),(4,'No tiene'),(5,'hojas'),(6,'Botes');
INSERT INTO `proveedor` VALUES (1,'Sams Club','Jiutepec','Luis Fernandez','7774495131','luis@samsclub.com',23),(2,'Liverpool','Cuernavaca','Adrian Silva','7770912321','adrian@liverpool.com',43),(3,'Peleteria la continetal','Cuernavaca','Ivan Flores','5554321185','ivanflores@gmail.com',12),(4,'Office Max','Ciudad de Mexico','Juan Perez','7772312345','juan@gmail.com',45);
INSERT INTO `insumos` VALUES (1,'Pluma','2002-02-12','2013-11-23',4,'cinco',56,'disponible',1,1,1,1,1,1,1,1,1,1,1,1),(3,'Tubo para pluma','2021-12-21','2024-11-04',22,'23',15,'Disponible',2,1,1,2,2,1,1,2,1,1,2,1),(7,'Material para enmicar','2024-11-14','2024-11-23',23,'23',1000,'Disponible',7,7,1,1,1,1,6,3,4,3,2,3);
INSERT INTO `empleado` VALUES (1,'Fernando','Bustamante','Leal','1970-08-26','Jiutepec','7772569841','fbustamante@prodigy.net.com','Representante','BUFE230J'),(2,'Leslie','Salinas','Rangel','2004-04-20','Yautepec','7356498750','lesliesalinas@gmail.com','Practicante','SALE204Y'),(3,'Joselin','Romaniz','lopez','0200-07-19','Jiutepec','7770236548','jromaniz@gmail.com','Empleado','ROJO456J'),(4,'Janairy','Sanchez','Vazquez','2002-12-27','Nispero 32 Jiutepec','7772345609','janairyalmon12@gmail.com','Practicante',NULL);
INSERT INTO `usuarios` VALUES (1,'FERBUS70','BUFE230J',1),(2,'LESSAL04','SALE204Y',2),(3,'JOSROM00','ROJO456J',3);
INSERT INTO `baja` VALUES (1,4,'2024-09-15','rotos',1,2),(2,1,'2024-09-20','Cuarteado',1,1);
INSERT INTO `estado` VALUES (1,'Pendiente'),(2,'En Proceso'),(3,'En Proceso'),(4,'Completado'),(5,'Cancelado'),(6,'Retrasado');
INSERT INTO `productoFinal` VALUES (1,'Playera con estampado pequeño',100),(2,'Collar para gafete',50),(3,'Tarjetas de 15 años',30),(4,'Taza sublimada',200),(5,'Playera sublimada',150),(8,'Pluma decorada',30);
INSERT INTO `pedido` VALUES (1,4,'Juan Lopez','2024-11-05',2,3,1),(3,6,'Ana Flores','2024-11-29',3,3,2);
INSERT INTO `detalle` VALUES (0000000001,50,100,150,360,1);
INSERT INTO `insumoproducto` VALUES (2,8,1,2,15);


