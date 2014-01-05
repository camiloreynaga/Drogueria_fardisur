<?php
$this->breadcrumbs=array(
	'Tipo Productos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tipo_producto', 'url'=>array('index')),
	array('label'=>'Create Tipo_producto', 'url'=>array('create')),
	array('label'=>'View Tipo_producto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tipo_producto', 'url'=>array('admin')),
);
?>

<h1>Update Tipo_producto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>