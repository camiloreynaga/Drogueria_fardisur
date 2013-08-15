<?php
$this->breadcrumbs=array(
	'Detalle Ventas',
);

$this->menu=array(
	array('label'=>'Create Detalle_venta', 'url'=>array('create')),
	array('label'=>'Manage Detalle_venta', 'url'=>array('admin')),
);
?>

<h1>Detalle Ventas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
