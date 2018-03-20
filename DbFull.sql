CREATE DATABASE IF NOT EXISTS BDatCompleta;
USE BDatCompleta;

CREATE TABLE  Categoria(
  IdCategoria tinyint(2) auto_increment not null,
  Nombre varchar(50),
  CONSTRAINT pk_Categoria PRIMARY KEY(IdCategoria)
) ENGINE=InnoDb;
