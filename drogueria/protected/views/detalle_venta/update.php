<?php
$this->breadcrumbs=array(
	'Detalle Ventas'=>array('index'),
	$model->id_detalle_venta=>array('view','id'=>$model->id_detalle_venta),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalle_venta', 'url'=>array('index')),
	array('label'=>'Create Detalle_venta', 'url'=>array('create')),
	array('label'=>'View Detalle_venta', 'url'=>array('view', 'id'=>$model->id_detalle_venta)),
	array('label'=>'Manage Detalle_venta', 'url'=>array('admin')),
);
?>

<h1>Update Detalle_venta <?php echo $model->id_detalle_venta; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>