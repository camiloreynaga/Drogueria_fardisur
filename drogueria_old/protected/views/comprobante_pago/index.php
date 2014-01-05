<?php
$this->breadcrumbs=array(
	'Comprobante Pagos',
);

$this->menu=array(
	array('label'=>'Create Comprobante_pago', 'url'=>array('create')),
	array('label'=>'Manage Comprobante_pago', 'url'=>array('admin')),
);
?>

<h1>Comprobante Pagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
