<?php
$this->breadcrumbs=array(
	'Tipo Productos',
);

$this->menu=array(
	array('label'=>'Create Tipo_producto', 'url'=>array('create')),
	array('label'=>'Manage Tipo_producto', 'url'=>array('admin')),
);
?>

<h1>Tipo Productos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
