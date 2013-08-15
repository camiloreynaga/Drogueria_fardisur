<?php
$this->breadcrumbs=array(
	'Cuenta Cobrars',
);

$this->menu=array(
	array('label'=>'Create Cuenta_cobrar', 'url'=>array('create')),
	array('label'=>'Manage Cuenta_cobrar', 'url'=>array('admin')),
);
?>

<h1>Cuenta Cobrars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
