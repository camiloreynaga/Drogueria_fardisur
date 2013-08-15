<?php
$this->breadcrumbs=array(
	'Cuenta Pagars'=>array('index'),
	$model->idcuenta_pagar=>array('view','id'=>$model->idcuenta_pagar),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cuenta_pagar', 'url'=>array('index')),
	array('label'=>'Create Cuenta_pagar', 'url'=>array('create')),
	array('label'=>'View Cuenta_pagar', 'url'=>array('view', 'id'=>$model->idcuenta_pagar)),
	array('label'=>'Manage Cuenta_pagar', 'url'=>array('admin')),
);
?>

<h1>Update Cuenta_pagar <?php echo $model->idcuenta_pagar; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>