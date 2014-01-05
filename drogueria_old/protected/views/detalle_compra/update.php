<?php
$this->breadcrumbs=array(
	'Detalle Compras'=>array('index'),
	$model->id_detalle_compra=>array('view','id'=>$model->id_detalle_compra),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalle_compra', 'url'=>array('index')),
	array('label'=>'Create Detalle_compra', 'url'=>array('create')),
	array('label'=>'View Detalle_compra', 'url'=>array('view', 'id'=>$model->id_detalle_compra)),
	array('label'=>'Manage Detalle_compra', 'url'=>array('admin')),
);
?>

<h1>Update Detalle_compra <?php echo $model->id_detalle_compra; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>