/**
 * bdusuarios.sql
 * Script de creación de la base de datos.
 */

/** Borra la base de datos si existe. */
drop database if exists BDUsuarios;

/** Crea la base de datos. */
create database BDUsuarios;

/** Crea el usuario para acceder a la base de datos. */
create or replace user 'UBDUsuarios'@'localhost' 
    identified by 'Lo-1234-lo';

/** Concede privilegios al usuario para acceder a la base de datos. */
grant select, insert, update, delete on BDUsuarios.* 
    to 'UBDUsuarios'@'localhost';

/** Selecciona la base de datos. */
use BDUsuarios;

/** Crea las tablas. */
CREATE TABLE Registros (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre varchar (50) not null,
    apellidos varchar (14),
    estado ENUM('solter@', 'casad@', 'divorciad@') NOT NULL,
    fechaNacimiento DATETIME,
    sexo varchar (1) not null
);

/** Carga inicial de datos. */
insert into Registros (idUsuario, nombre, apellidos, estado, fechaNacimiento, sexo)
Values (2,'Marta','Molina Segovia','solter@','2001-12-12','M');
