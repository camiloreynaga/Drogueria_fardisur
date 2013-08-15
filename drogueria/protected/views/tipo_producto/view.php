<?php
$this->breadcrumbs=array(
	'Tipo Productos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tipo_producto', 'url'=>array('index')),
	array('label'=>'Create Tipo_producto', 'url'=>array('create')),
	array('label'=>'Update Tipo_producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tipo_producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tipo_producto', 'url'=>array('admin')),
);
?>

<h1>View Tipo_producto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipo_producto',
	),
)); ?>
