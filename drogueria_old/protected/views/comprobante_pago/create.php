<?php
$this->breadcrumbs=array(
	'Comprobante Pagos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comprobante_pago', 'url'=>array('index')),
	array('label'=>'Manage Comprobante_pago', 'url'=>array('admin')),
);
?>

<h1>Create Comprobante_pago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>