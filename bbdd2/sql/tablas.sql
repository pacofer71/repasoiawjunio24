create table articulos(
    id int unsigned auto_increment primary key,
    nombre varchar(30) unique not null,
    descripcion text not null,
    tipo enum('bazar','digital'),
    precio decimal(6,2)
);

insert into articulos(nombre, descripcion, tipo, precio) values('Articulo 1','Descripcion 1','bazar',123.45);
insert into articulos(nombre, descripcion, tipo, precio) values('Articulo 2','Descripcion 2','digital',223.45);
insert into articulos(nombre, descripcion, tipo, precio) values('Articulo 3','Descripcion 3','bazar',103.45);
insert into articulos(nombre, descripcion, tipo, precio) values('Articulo 4','Descripcion 4','digital',423.45);
insert into articulos(nombre, descripcion, tipo, precio) values('Articulo 5','Descripcion 5','bazar',1238.45);