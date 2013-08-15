<?php
$this->breadcrumbs=array(
	'Laboratorios',
);

$this->menu=array(
	array('label'=>'Create Laboratorio', 'url'=>array('create')),
	array('label'=>'Manage Laboratorio', 'url'=>array('admin')),
);
?>

<h1>Laboratorios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
