Vistas

vista compra

create view vcompra
as
SELECT producto,SUM(cantidad_disponible) stock_real FROM detalle_compra
GROUP BY producto ORDER BY producto ASC;


create view vventa
as
SELECT id_producto, SUM(cantidad) cantidad FROM detalle_venta  
GROUP BY id_producto ORDER BY id_producto ASC


///COnsulta para actualizar stock

select id,nombre_producto,C.stock_real,P.stock
from producto P
inner join vcompras C on C.producto = P.id
order by C.stock_real asc

--
///Consulta para actualizar el stock en toda la tabla producto

update producto P inner join vcompras C on P.id=C.producto set P.stock = C.stock_real
---

update producto set stock = (select stock_real from vcompras) where id= 7



--otras consultas

SELECT nombre_producto,stock FROM producto ORDER BY nombre_producto ASC;


SELECT nombre_producto,SUM(cantidad_disponible) stock_real FROM detalle_compra DC
INNER JOIN producto TP ON TP.id = DC.producto
GROUP BY DC.producto ORDER BY nombre_producto ASC;


SELECT nombre_producto, SUM(cantidad) FROM detalle_venta  DV
INNER JOIN producto TP ON TP.id = DV.id_producto
GROUP BY id_producto ORDER BY nombre_producto ASC


select id,nombre_producto,C.stock_real,V.cantidad
from producto P
inner join vcompras C on C.producto = P.id
inner join vventas V on V.id_producto =P.id