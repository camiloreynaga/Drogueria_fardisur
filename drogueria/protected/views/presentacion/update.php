<?php
$this->breadcrumbs=array(
	'Presentacions'=>array('index'),
	$model->id_presentacion=>array('view','id'=>$model->id_presentacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Presentacion', 'url'=>array('index')),
	array('label'=>'Create Presentacion', 'url'=>array('create')),
	array('label'=>'View Presentacion', 'url'=>array('view', 'id'=>$model->id_presentacion)),
	array('label'=>'Manage Presentacion', 'url'=>array('admin')),
);
?>

<h1>Update Presentacion <?php echo $model->id_presentacion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>