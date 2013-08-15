<?php
$this->breadcrumbs=array(
	'Tipo Comprobantes'=>array('index'),
	$model->id_tipo_comprobante,
);

$this->menu=array(
	array('label'=>'List Tipo_comprobante', 'url'=>array('index')),
	array('label'=>'Create Tipo_comprobante', 'url'=>array('create')),
	array('label'=>'Update Tipo_comprobante', 'url'=>array('update', 'id'=>$model->id_tipo_comprobante)),
	array('label'=>'Delete Tipo_comprobante', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tipo_comprobante),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tipo_comprobante', 'url'=>array('admin')),
);
?>

<h1>View Tipo_comprobante #<?php echo $model->id_tipo_comprobante; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tipo_comprobante',
		'comprobante',
	),
)); ?>
