<?php
$this->breadcrumbs=array(
	'Cuenta Cobrars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuenta_cobrar', 'url'=>array('index')),
	array('label'=>'Manage Cuenta_cobrar', 'url'=>array('admin')),
);
?>

<h1>Create Cuenta_cobrar</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>