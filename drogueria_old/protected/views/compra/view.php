<?php
$this->breadcrumbs=array(
	'Compras'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Compra', 'url'=>array('index')),
	array('label'=>'Create Compra', 'url'=>array('create')),
	array('label'=>'Update Compra', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Update Detalle Compra', 'url'=>array('agregardetalle', 'id'=>$model->id)),
	array('label'=>'Delete Compra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Compra', 'url'=>array('admin')),
);
?>

<h1>View Compra #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_compra',
            array(
                   'name'=>'Proveedor',
                   'value'=>$model->id_proveedor0->nombre_proveedor
                    ),
		//'id_proveedor',
		'nro_factura',
		'cantidad_cuotas',
            array
                    ('name'=>'almacen',
                    'value'=>$model->almacen0->almacen
                    ),
		//'almacen',
		'observaciones',
                'impuesto',
                'total'
	),
)); 

$detalleCompra=new Detalle_compra;
$detalleCompra->id_compra=$model->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-compra-grid',
	'dataProvider'=>$detalleCompra->search(),
	'columns'=>array(
		array(
                    'name'=>'producto',
                    'value'=>'$data->producto0->nombre_producto'
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
                            'url'=>'Yii::app()->createUrl("compra/deleteItem", array("id"=>$data->id_detalle_compra))',
                        )
                    ),
                    'deleteConfirmation'=>'Esta seguro de eliminar este item?',
                    'afterDelete'=>'function(link,success,data){ if(success) window.location.reload(); }',
		),*/
	),
));
    $criteria= new CDbCriteria;
    $criteria->compare('compra',$model->id);

    $dataProvider=new CActiveDataProvider('Cuenta_pagar',array('criteria'=>$criteria));
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'cuenta-pagar-grid',
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
                   // 'interes',
                    array(//buttons
                            'header'=>'Acciones',
                            'class'=>'CButtonColumn',
                            'template'=>'{pagar}',
                            'buttons'=>array(
                                'pagar'=>array(
                                    //'url'=>'Yii::app()->createUrl("compra/deleteCuota", array("id"=>$data->idcuenta_pagar))',
                                    'url'=>'Yii::app()->createUrl("compra/PagarCuenta", array("id"=>$data->idcuenta_pagar,"idCompra"=>$data->compra))',
                                    'label'=>'Pagar',
                                    'visible'=>'$data->estado==0'
                                )
                            ),

                    ),
            ),
    ));
?>
