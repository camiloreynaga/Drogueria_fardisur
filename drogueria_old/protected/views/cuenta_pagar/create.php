<?php
$this->breadcrumbs=array(
	'Cuenta Pagars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuenta_pagar', 'url'=>array('index')),
	array('label'=>'Manage Cuenta_pagar', 'url'=>array('admin')),
);
?>

<h1>Create Cuenta_pagar</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>