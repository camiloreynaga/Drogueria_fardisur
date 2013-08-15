<?php
$this->breadcrumbs=array(
	'Laboratorios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Laboratorio', 'url'=>array('index')),
	array('label'=>'Create Laboratorio', 'url'=>array('create')),
	array('label'=>'Update Laboratorio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Laboratorio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Laboratorio', 'url'=>array('admin')),
);
?>

<h1>View Laboratorio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'laboratorio',
	),
)); ?>
