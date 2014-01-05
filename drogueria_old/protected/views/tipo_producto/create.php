<?php
$this->breadcrumbs=array(
	'Tipo Productos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tipo_producto', 'url'=>array('index')),
	array('label'=>'Manage Tipo_producto', 'url'=>array('admin')),
);
?>

<h1>Create Tipo_producto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>