create table articulos(
    id int auto_increment primary key,
    nombre varchar(50) unique not null,
    stock int default 0,
    descripcion text not null
);

insert into articulos(nombre, stock, descripcion) values('Articulo 1', 1, 'Descripcion 1');
insert into articulos(nombre, stock, descripcion) values('Articulo 2', 2, 'Descripcion 2');
insert into articulos(nombre, stock, descripcion) values('Articulo 3', 5, 'Descripcion 3');
insert into articulos(nombre, stock, descripcion) values('Articulo 4', 7, 'Descripcion 4');
insert into articulos(nombre, stock, descripcion) values('Articulo 5', 9, 'Descripcion 5');
insert into articulos(nombre, stock, descripcion) values('Articulo 6', 9, 'Descripcion 6');
insert into articulos(nombre, stock, descripcion) values('Articulo 7', 56, 'Descripcion 7');
insert into articulos(nombre, stock, descripcion) values('Articulo 8', 7, 'Descripcion 8');
insert into articulos(nombre, stock, descripcion) values('Articulo 9', 8, 'Descripcion 9');
insert into articulos(nombre, stock, descripcion) values('Articulo 10', 3, 'Descripcion 10');