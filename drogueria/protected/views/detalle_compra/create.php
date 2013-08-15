<?php
$this->breadcrumbs=array(
	'Detalle Compras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalle_compra', 'url'=>array('index')),
	array('label'=>'Manage Detalle_compra', 'url'=>array('admin')),
);
?>

<h1>Create Detalle_compra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>