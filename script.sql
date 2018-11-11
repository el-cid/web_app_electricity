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

CREATE TABLE region(
    idRegion CHAR(3),
    nombre VARCHAR(19),
    idSistema CHAR(3),
    PRIMARY KEY ( idRegion ),
    FOREIGN KEY ( idSistema ) REFERENCES sistema( idSistema ) ON DELETE CASCADE
);

CREATE TABLE consumo(
    idRegion CHAR(3),
    year INT NOT NULL,
    month INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY ( idRegion, year , month ),
    FOREIGN KEY ( idRegion ) REFERENCES region( idRegion ) ON DELETE CASCADE 
);

INSERT INTO sistema( idSistema , nombre ) VALUES ('BCA','Baja California'),
                                                 ('BCS','Baja California Sur'),
                                                 ('SIN','Nacional');

INSERT INTO region( idSistema , idRegion , nombre ) VALUES ('BCA','BCA','Baja California'),
                                                           ('BCS','BCS','Baja California Sur'),
                                                           ('SIN','CEL','Central'),
                                                           ('SIN','ORI','Oriental'),
                                                           ('SIN','OCC','Occidental'),
                                                           ('SIN','NOR','Noroeste'),
                                                           ('SIN','NTE','Norte'),
                                                           ('SIN','NES','Noreste'),
                                                           ('SIN','PEN','Peninsular');
                                                                                
