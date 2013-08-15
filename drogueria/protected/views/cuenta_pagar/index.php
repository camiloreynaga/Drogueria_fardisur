<?php
$this->breadcrumbs=array(
	'Cuenta Pagars',
);

$this->menu=array(
	array('label'=>'Create Cuenta_pagar', 'url'=>array('create')),
	array('label'=>'Manage Cuenta_pagar', 'url'=>array('admin')),
);
?>

<h1>Cuenta Pagars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
