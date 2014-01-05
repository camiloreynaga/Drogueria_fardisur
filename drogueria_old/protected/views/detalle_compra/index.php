<?php
$this->breadcrumbs=array(
	'Detalle Compras',
);

$this->menu=array(
	array('label'=>'Create Detalle_compra', 'url'=>array('create')),
	array('label'=>'Manage Detalle_compra', 'url'=>array('admin')),
);
?>

<h1>Detalle Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
