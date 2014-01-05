<?php
$this->breadcrumbs=array(
	'Almacens'=>array('index'),
	$model->id_almacen,
);

$this->menu=array(
	array('label'=>'List Almacen', 'url'=>array('index')),
	array('label'=>'Create Almacen', 'url'=>array('create')),
	array('label'=>'Update Almacen', 'url'=>array('update', 'id'=>$model->id_almacen)),
	array('label'=>'Delete Almacen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_almacen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Almacen', 'url'=>array('admin')),
);
?>

<h1>View Almacen #<?php echo $model->id_almacen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_almacen',
		'almacen',
	),
)); ?>
