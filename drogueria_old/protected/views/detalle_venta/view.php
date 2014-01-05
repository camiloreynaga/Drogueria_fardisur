<?php
$this->breadcrumbs=array(
	'Detalle Ventas'=>array('index'),
	$model->id_detalle_venta,
);

$this->menu=array(
	array('label'=>'List Detalle_venta', 'url'=>array('index')),
	array('label'=>'Create Detalle_venta', 'url'=>array('create')),
	array('label'=>'Update Detalle_venta', 'url'=>array('update', 'id'=>$model->id_detalle_venta)),
	array('label'=>'Delete Detalle_venta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_detalle_venta),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalle_venta', 'url'=>array('admin')),
);
?>

<h1>View Detalle_venta #<?php echo $model->id_detalle_venta; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_detalle_venta',
		'id_venta',
		'id_producto',
		'lote',
		'cantidad',
		'precio_unitario',
	),
)); ?>
