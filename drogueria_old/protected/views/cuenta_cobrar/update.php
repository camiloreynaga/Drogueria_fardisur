<?php
$this->breadcrumbs=array(
	'Cuenta Cobrars'=>array('index'),
	$model->idcuenta_cobrar=>array('view','id'=>$model->idcuenta_cobrar),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cuenta_cobrar', 'url'=>array('index')),
	array('label'=>'Create Cuenta_cobrar', 'url'=>array('create')),
	array('label'=>'View Cuenta_cobrar', 'url'=>array('view', 'id'=>$model->idcuenta_cobrar)),
	array('label'=>'Manage Cuenta_cobrar', 'url'=>array('admin')),
);
?>

<h1>Update Cuenta_cobrar <?php echo $model->idcuenta_cobrar; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>