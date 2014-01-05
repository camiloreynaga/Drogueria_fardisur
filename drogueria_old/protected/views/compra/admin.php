<?php
$this->breadcrumbs=array(
	'Compras'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Compra', 'url'=>array('index')),
	array('label'=>'Create Compra', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('compra-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Compras</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'compra-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha_compra',
		array('name'=>'id_proveedor',
		'value'=>'$data->id_proveedor0->nombre_proveedor',
                'filter'=>CHtml::dropDownList('Compra[id_proveedor]',array(),CHtml::listData(Compra::model()->getListProveedor(),'id','nombre_proveedor'),array('prompt'=>'-- Seleccione --'))
                    ),
		//'id_proveedor',
		'nro_factura',
		'cantidad_cuotas',
		array('name'=>'almacen',
		'value'=>'$data->almacen0->almacen'),
		//'almacen',
		/*
		'observaciones',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
