<?php
$this->breadcrumbs=array(
	'Ventas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Venta', 'url'=>array('index')),
	array('label'=>'Create Venta', 'url'=>array('create')),
	array('label'=>'Update Venta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Venta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Venta', 'url'=>array('admin'))
        //array('label'=>'Imprimir factura','url'=>array('venta/BuildPdf','id'=>$model->id))
    //array('label'=>'Imprimir','url'=>array('facturacion2/factura.php','id'=>$model->id))
);
?>

<h1>Ver Venta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array(
                    'name'=>'Cliente',
                    'value'=>$model->id_cliente0->nombre
                ),
            array(
                'name'=>'Empleado',
                'value'=>$model->id_empleado0->nombre
            ),
		'fecha_venta',
		'forma_envio',
		'forma_pago',
		'cantidad_cuotas',
	),
)); 
echo "<h1>Productos seleccionados</h1>";
    $detalle=new Detalle_venta;
    $detalle->id_venta=$model->id;
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'detalle-venta-grid',
            'dataProvider'=>$detalle->search(),
            'columns'=>array(
                    array(
                        'name'=>'producto',
                        'value'=>'$data->id_producto0->nombre_producto'
                    ),
                    array(
                        'name'=>'cantidad',
                        'value'=>'$data->cantidad." (und)"'
                    ),
                    array(
                        'name'=>'precio_unitario',
                        'value'=>'"S./ ".$data->precio_unitario'
                    ),
                    'lote',
                    array(
                      'name'=>'subtotal',
                      'value'=>'"S./ ".$data->subtotal'
                    ),
                    /*
                    'fecha_vencimiento',
                    'ganancia',
                    */
                    /*array(
                        'class'=>'CButtonColumn',
                        'template'=>'{delete}',
                        'buttons'=>array(
                            'delete'=>array(
                                'url'=>'Yii::app()->createUrl("venta/deleteItem", array("id"=>$data->id_detalle_venta))',
                            )
                        ),
                        'deleteConfirmation'=>'Esta seguro de eliminar este item?',
                        'afterDelete'=>'function(link,success,data){ if(success) window.location.reload(); }',
                    ),*/
            ),
    )); 
echo "<h1>Cuentas</h1>";
        $criteria= new CDbCriteria;
        $criteria->compare('venta',$model->id);
        
        $dataProvider=new CActiveDataProvider('Cuenta_cobrar',array('criteria'=>$criteria));
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'cuenta-cobrar-grid',
                'dataProvider'=>$dataProvider,
                //'filter'=>$model,
                'columns'=>array(
                        'monto',
                        array(
                                'name'=>'estado',
                                'type'=>'raw',
                                'value'=>'$data->estado==0?"Pendiente":"Pagado"'
                            ),
                        'fecha_pago',
                        //'interes',
                        array(
                                'header'=>'Acciones',
                                'class'=>'CButtonColumn',
                                'template'=>'{payment}',
                                'buttons'=>array(
                                    'payment'=>array(
                                        //'url'=>'Yii::app()->createUrl("venta/deleteCuota", array("id"=>$data->idcuenta_cobrar))',
                                        'url'=>'Yii::app()->createUrl("venta/pagarCuenta", array("id"=>$data->idcuenta_cobrar,"idventa"=>$data->venta))',
                                        'visible'=>'$data->estado!=1',
                                        'label'=>'Pagar',
                                        
                                        //'linkOptions'=>array('Esta seguro de proceder con el pago?')
                                        //'confirm'=>''
                                )
                                    
                            ),
                        ),
                ),
        )); 
if(isset($_GET['print']))
{?>
<!--<script>
    setTimeout('window.open("<?php //echo Yii::app()->createAbsoluteUrl('venta/BuildPdf',array('id'=>$model->id));?>")',1500);
</script>-->

<?php } ?>
<a href="facturacion2/factura.php?id_venta=<?php echo $model->id; ?>" target="blank" >Facturar</a></p>