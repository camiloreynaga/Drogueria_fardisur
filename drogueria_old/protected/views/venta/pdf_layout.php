<div>
    <?php   
    echo $data->fecha_venta.'<br/>';
    echo $data->id_cliente0->nombre.'<br/>';
    echo $data->id_cliente0->ruc.'<br/>';
    echo $data->id_cliente0->direccion.'<br/>';
    echo $data->id_cliente0->id.'<br/>';
    ?>
</div>

<?php 

echo "<table border='0'>";
foreach($data->detalle_ventas as $detalle)
{
    
    echo '<tr>';
        echo '<td>'.$detalle->cantidad.'</td>';
        echo '<td>'.CHtml::encode($detalle->id_producto0->nombre_producto.' '.$detalle->id_producto0->concentracion.' / '.$detalle->id_producto0->presentacion0->presentacion).'</td>';
        echo '<td>'.$detalle->lote.'</td>';
        echo '<td>'.$detalle->fecha_vencimiento.'</td>';
        echo '<td>'.$detalle->precio_unitario.'</td>';
        echo '<td>'.$detalle->subtotal.'</td>';
    echo '</tr>';
}
echo "</table>";
echo "</br>";
echo "<div>".ucfirst($texto)."</div>";

?>