<?php
$this->breadcrumbs=array(
	'Cuenta Cobrars'=>array('index'),
	$model->idcuenta_cobrar,
);

$this->menu=array(
	array('label'=>'List Cuenta_cobrar', 'url'=>array('index')),
	array('label'=>'Create Cuenta_cobrar', 'url'=>array('create')),
	array('label'=>'Update Cuenta_cobrar', 'url'=>array('update', 'id'=>$model->idcuenta_cobrar)),
	array('label'=>'Delete Cuenta_cobrar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcuenta_cobrar),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cuenta_cobrar', 'url'=>array('admin')),
);
?>

<h1>View Cuenta_cobrar #<?php echo $model->idcuenta_cobrar; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcuenta_cobrar',
		'venta',
		'monto',
		'fecha_pago',
		'estado',
	),
)); ?>
