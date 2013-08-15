<?php
$this->breadcrumbs=array(
	'Cuenta Pagars'=>array('index'),
	$model->idcuenta_pagar,
);

$this->menu=array(
	array('label'=>'List Cuenta_pagar', 'url'=>array('index')),
	array('label'=>'Create Cuenta_pagar', 'url'=>array('create')),
	array('label'=>'Update Cuenta_pagar', 'url'=>array('update', 'id'=>$model->idcuenta_pagar)),
	array('label'=>'Delete Cuenta_pagar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcuenta_pagar),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cuenta_pagar', 'url'=>array('admin')),
);
?>

<h1>View Cuenta_pagar #<?php echo $model->idcuenta_pagar; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcuenta_pagar',
		'compra',
		'monto',
		'estado',
		'fecha_pago',
		'interes',
	),
)); ?>
