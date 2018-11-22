CREATE DATABASE sen;
CREATE USER 'sen_user'@'localhost' IDENTIFIED BY 'tAlLeR_pAsSwOrD_0';
GRANT ALL ON sen.* TO 'sen_user'@'localhost';
FLUSH PRIVILEGES;
USE sen;

CREATE TABLE sistema(
    idSistema CHAR(3),
    nombre CHAR(19),
    PRIMARY KEY ( idSistema )
);

INSERT INTO sistema( idSistema , nombre ) VALUES ('BCA','Baja California'),
                                                 ('BCS','Baja California Sur'),
                                                 ('SIN','Nacional');
CREATE TABLE region(
    idRegion CHAR(3),
    nombre VARCHAR(19),
    idSistema CHAR(3),
    PRIMARY KEY ( idRegion ),
    FOREIGN KEY ( idSistema ) REFERENCES sistema( idSistema ) ON DELETE CASCADE
);

INSERT INTO region( idSistema , idRegion , nombre ) VALUES ('BCA','BCA','Baja California'),
                                                           ('BCS','BCS','Baja California Sur'),
                                                           ('SIN','CEL','Central'),
                                                           ('SIN','ORI','Oriental'),
                                                           ('SIN','OCC','Occidental'),
                                                           ('SIN','NOR','Noroeste'),
                                                           ('SIN','NTE','Norte'),
                                                           ('SIN','NES','Noreste'),
                                                           ('SIN','PEN','Peninsular');

CREATE TABLE consumo(
    idRegion CHAR(3),
    year INT NOT NULL,
    month INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY ( idRegion, year , month ),
    FOREIGN KEY ( idRegion ) REFERENCES region( idRegion ) ON DELETE CASCADE 
);

CREATE TABLE estado(
    idEstado VARCHAR(2),
    nombre VARCHAR(19) NOT NULL,
    PRIMARY KEY ( idEstado )
);

INSERT INTO estado ( idEstado , nombre ) VALUES ('1', 'Aguascalientes'),
                                                ('2', 'Baja California'),
                                                ('3', 'Baja California Sur'),
                                                ('4', 'Campeche'),
                                                ('5', 'Coahuila'),
                                                ('6', 'Colima'),
                                                ('7', 'Chiapas'),
                                                ('8', 'Chihuahua'),
                                                ('9', 'Ciudad de México'),
                                                ('10', 'Durango'),
                                                ('11', 'Guanajuato'),
                                                ('12', 'Guerrero'),
                                                ('13', 'Hidalgo'),
                                                ('14', 'Jalisco'),
                                                ('15', 'México'),
                                                ('16', 'Michoacán'),
                                                ('17', 'Morelos'),
                                                ('18', 'Nayarit'),
                                                ('19', 'Nuevo León'),
                                                ('20', 'Oaxaca'),
                                                ('21', 'Puebla'),
                                                ('22', 'Querétaro'),
                                                ('23', 'Quintana Roo'),
                                                ('24', 'San Luis Potosí'),
                                                ('25', 'Sinaloa'),
                                                ('26', 'Sonora'),
                                                ('27', 'Tabasco'),
                                                ('28', 'Tamaulipas'),
                                                ('29', 'Tlaxcala'),
                                                ('30', 'Veracruz'),
                                                ('31', 'Yucatán'),
                                                ('32', 'Zacatecas');

CREATE TABLE nodo(
    idNodo VARCHAR(12),
    nombre VARCHAR(30) NOT NULL,
    tension SMALLINT NOT NULL,
    idEstado VARCHAR(2) NOT NULL,
    idRegion CHAR(3) NOT NULL,
    PRIMARY KEY ( idNodo ),
    FOREIGN KEY ( idEstado ) REFERENCES estado ( idEstado ),
    FOREIGN KEY ( idRegion ) REFERENCES region ( idRegion )
);

CREATE TABLE precio_mda(
    idNodo VARCHAR(12),
    fecha DATE,
    hora SMALLINT,
    precioMarginal DOUBLE NOT NULL,
    PRIMARY KEY ( idNodo , fecha , hora ),
    FOREIGN KEY ( idNodo ) REFERENCES nodo( idNodo ) ON DELETE CASCADE
);
                                                                                                                                    59,65         Bot
 
