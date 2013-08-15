<?php
$this->breadcrumbs=array(
	'Tipo Comprobantes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tipo_comprobante', 'url'=>array('index')),
	array('label'=>'Manage Tipo_comprobante', 'url'=>array('admin')),
);
?>

<h1>Create Tipo_comprobante</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>