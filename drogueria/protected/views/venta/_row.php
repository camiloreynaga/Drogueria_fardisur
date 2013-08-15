<div >
    <div style="float:left;"><?php echo $data->cantidad?></div>   
    <div style="float:left;padding:0 15px;"><?php echo $data->cantidad?></div>
    <div style="float:left;"><?php echo $data->id_producto0->nombre_producto.' '.$data->id_producto0->concentracion.' / '.$data->id_producto0->presentacion0->presentacion?></div>
    <div style="float:left;padding:0 15px;"><?php echo $data->lote?></div>
    <div style="float:left;padding:0 15px;"><?php echo $data->fecha_vencimiento?></div>
    <div style="float:left;padding:0 15px;"><?php echo $data->precio_unitario?></div>
    <div style="float:left;padding:0 15px;"><?php echo $data->subtotal?></div>
</div>