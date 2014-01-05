<?php
$this->breadcrumbs=array(
	'Comprobante Pagos'=>array('index'),
	$model->idcomprobante_pago,
);

$this->menu=array(
	array('label'=>'List Comprobante_pago', 'url'=>array('index')),
	array('label'=>'Create Comprobante_pago', 'url'=>array('create')),
	array('label'=>'Update Comprobante_pago', 'url'=>array('update', 'id'=>$model->idcomprobante_pago)),
	array('label'=>'Delete Comprobante_pago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcomprobante_pago),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comprobante_pago', 'url'=>array('admin')),
);
?>

<h1>View Comprobante_pago #<?php echo $model->idcomprobante_pago; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcomprobante_pago',
		'venta',
		'tipo',
		'serie',
		'numero',
		'estado',
	),
)); ?>
