#CREAR BASE DE DATOS
create database ctc_hmo2;

#ACCEDER A LA BASE DE DATOS
use ctc_hmo2;

#CREAR TABLA COLONIAS
CREATE TABLE colonias(
	coloniaId INT(11) NOT NULL auto_increment,
	nombreColonia VARCHAR(11) not null,
	PRIMARY KEY(coloniaId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#INSERCIÓN DE DATOS EN TABLA COLONIAS
INSERT INTO colonias (nombreColonia) VALUES
	('4 DE MARZO'),
	('4 OLIVOS'),
	('5 DE MAYO'),
	('AGUALURCA'),
	('ADOLFO DE LA HUERTA'),
	('AKIWIKI'),
	('ALCALA'),
	('ALTA CALIFORNIA'),
	('ALTARES'),
	('AMAPOLAS'),
	('ALVARO OBREGON'),
	('ANDALUCIA'),
	('APACHE'),
	('APOLO'),
	('ANTARA'),
	('ARANDANOS'),
	('ARBOLEDA'),
	('ARANJUEZ'),
	('ASTURIAS'),
	('ATARDECERES');

select * from colonias;

#CREAR TABLA NODOS
CREATE TABLE nodos(
	nodoId INT(11) NOT NULL auto_increment,
	numNodo INT(3) NOT NULL,
	ubiCTC VARCHAR(30) NOT NULL,
	nivelNodo VARCHAR(3) NOT NULL,
	tipoNodo VARCHAR(20) NOT NULL,
	direccionNodo VARCHAR(200) NOT NULL,
	latNodo FLOAT(30) NOT NULL,
	lngNodo FLOAT(30) NOT NULL,
	PRIMARY KEY(nodoId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#INSERCIÓN DE DATOS EN TABLA NODOS
INSERT INTO nodos (numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo) VALUES
	(0, '2C', '22', 'BDR 2:1', 'Av. Siempre Viva', -33.012345, -77.12345),
	(1, 'D', '34', 'BDR 4:1', 'Calle Sin Nombre', -27.78945, -34.56789),
	(2, 'L / A''', '34', 'BDR 2:1', 'Av. Siempre Viva', -33.012345, -77.12345),
	(3, '4C', '34', 'BDR 2:1', 'Calle Sin Nombre', -27.78945, -34.56789),
	(4, '2F', '34', 'BDR 4:1', 'Av. Siempre Viva', -33.012345, -77.12345),
	(5, 'H''', '18', 'BDR 4:1',  'Calle Sin Nombre', -27.78945, -34.56789),
	(6, '2G', '32', 'BDR 1:1', 'Av. Siempre Viva', -33.012345, -77.12345),
	(7, '5B', '34', 'BDR 2:1', 'Calle Sin Nombre', -27.78945, -34.56789),
	(8, '1E / 6C', '18', 'BDR 1:1', 'Av. Siempre Viva', -33.012345, -77.12345),
	(9, '2A', '34', 'BDR 2:1', 'Calle Sin Nombre', -27.78945, -34.56789);

#CREAR TABLA RELACIONES CON LLAVES FORÁNEAS Y RESTRICCIONES
CREATE TABLE relaciones(
	reIdColonia INT(11) NOT NULL,
	reIdNodo INT(11) NOT NULL,
	KEY fkColonia(reIdColonia),
	KEY fkNodo(reIdNodo),
	CONSTRAINT reIdColonia
		FOREIGN KEY(reIdColonia)
		REFERENCES colonias(coloniaId) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT reIdNodo
		FOREIGN KEY(reIdNodo)
		REFERENCES nodos(nodoId) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#INSERCIÓN DE DATOS EN TABLA RELACIONES
INSERT INTO `relaciones` (`reidColonia`, `reidNodo`) VALUES
	(1, 1),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4);

-- 5 de mayo tiene el nodo 1 / 102 / 197 / 236/ 237 / 238
 -- SELECT * FROM colonias c, nodos n WHERE c.coloniaId = n.nodoId;

-- SELECT numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo FROM nodos n INNER JOIN colonias c ON n.nodoId = c.coloniaId WHERE nombreColonia = '5 de Mayo';

SELECT numNodo, ubiCTC, nivelNodo, tipoNodo, direccionNodo, latNodo, lngNodo, nombreColonia
FROM relaciones r
INNER JOIN colonias c ON r.reIdColonia = c.coloniaId
INNER JOIN nodos n ON r.reIdNodo = n.nodoId
WHERE nombreColonia = '4 Olivos';