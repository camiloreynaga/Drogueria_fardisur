<?php
$this->breadcrumbs=array(
	'Detalle Ventas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalle_venta', 'url'=>array('index')),
	array('label'=>'Manage Detalle_venta', 'url'=>array('admin')),
);
?>

<h1>Create Detalle_venta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>