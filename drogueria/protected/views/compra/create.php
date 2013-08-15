<?php
$this->breadcrumbs=array(
	'Compras'=>array('index'),
	'Crear Compra',
);

$this->menu=array(
	array('label'=>'List Compra', 'url'=>array('index')),
	array('label'=>'Manage Compra', 'url'=>array('admin')),
);
?>

<h1>Crear Compra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>