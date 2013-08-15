<?php
$this->breadcrumbs=array(
	'Laboratorios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Laboratorio', 'url'=>array('index')),
	array('label'=>'Create Laboratorio', 'url'=>array('create')),
	array('label'=>'View Laboratorio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Update Laboratorio <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>