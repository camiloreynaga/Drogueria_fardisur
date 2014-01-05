<?php
$this->breadcrumbs=array(
	'Presentacions'=>array('index'),
	$model->id_presentacion,
);

$this->menu=array(
	array('label'=>'List Presentacion', 'url'=>array('index')),
	array('label'=>'Create Presentacion', 'url'=>array('create')),
	array('label'=>'Update Presentacion', 'url'=>array('update', 'id'=>$model->id_presentacion)),
	array('label'=>'Delete Presentacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_presentacion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Presentacion', 'url'=>array('admin')),
);
?>

<h1>View Presentacion #<?php echo $model->id_presentacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_presentacion',
		'presentacion',
		'nomeclatura',
	),
)); ?>
