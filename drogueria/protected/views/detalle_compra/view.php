<?php
$this->breadcrumbs=array(
	'Detalle Compras'=>array('index'),
	$model->id_detalle_compra,
);

$this->menu=array(
	array('label'=>'List Detalle_compra', 'url'=>array('index')),
	array('label'=>'Create Detalle_compra', 'url'=>array('create')),
	array('label'=>'Update Detalle_compra', 'url'=>array('update', 'id'=>$model->id_detalle_compra)),
	array('label'=>'Delete Detalle_compra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_detalle_compra),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalle_compra', 'url'=>array('admin')),
);
?>

<h1>View Detalle_compra #<?php echo $model->id_detalle_compra; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_detalle_compra',
		'id_compra',
		'producto',
		'cantidad',
		'precio_unitario',
		'lote',
		'fecha_vencimiento',
		//'ganancia',
	),
)); ?>
