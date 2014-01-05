<?php
$this->breadcrumbs=array(
	'Tipo Comprobantes'=>array('index'),
	$model->id_tipo_comprobante=>array('view','id'=>$model->id_tipo_comprobante),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tipo_comprobante', 'url'=>array('index')),
	array('label'=>'Create Tipo_comprobante', 'url'=>array('create')),
	array('label'=>'View Tipo_comprobante', 'url'=>array('view', 'id'=>$model->id_tipo_comprobante)),
	array('label'=>'Manage Tipo_comprobante', 'url'=>array('admin')),
);
?>

<h1>Update Tipo_comprobante <?php echo $model->id_tipo_comprobante; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>