<?php
$this->breadcrumbs=array(
	'Comprobante Pagos'=>array('index'),
	$model->idcomprobante_pago=>array('view','id'=>$model->idcomprobante_pago),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comprobante_pago', 'url'=>array('index')),
	array('label'=>'Create Comprobante_pago', 'url'=>array('create')),
	array('label'=>'View Comprobante_pago', 'url'=>array('view', 'id'=>$model->idcomprobante_pago)),
	array('label'=>'Manage Comprobante_pago', 'url'=>array('admin')),
);
?>

<h1>Update Comprobante_pago <?php echo $model->idcomprobante_pago; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>