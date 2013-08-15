<?php
$this->breadcrumbs=array(
	'Tipo Comprobantes',
);

$this->menu=array(
	array('label'=>'Create Tipo_comprobante', 'url'=>array('create')),
	array('label'=>'Manage Tipo_comprobante', 'url'=>array('admin')),
);
?>

<h1>Tipo Comprobantes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
