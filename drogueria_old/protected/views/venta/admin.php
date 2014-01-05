<?php
$this->breadcrumbs=array(
	'Ventas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Venta', 'url'=>array('index')),
	array('label'=>'Create Venta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('venta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ventas</h1>

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
	'id'=>'venta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'id_cliente',
		array('name'=>'id_cliente',
		'value'=>'$data->id_cliente0->nombre',
                'filter'=>CHtml::dropDownList('Venta[id_cliente]',  array(),CHtml::listData(Venta::model()->getListCliente(),'id','nombre'),array('prompt'=>'-- Seleccione --'))
                    ),
		//'id_empleado',
		array('name'=>'id_empleado',
		'value'=>'$data->id_empleado0->nombre',
                'filter'=>CHtml::dropDownList('Venta[id_empleado]',array(),CHtml::listData(Venta::model()->getListEmpleado(),'id','nombre'),array('prompt'=>'-- Seleccione --'))   
                    ),
		'fecha_venta',
		'forma_envio',
		'forma_pago',
		/*
		'cantidad_cuotas',
		*/
		array(
                    'class'=>'CButtonColumn',
                    'deleteConfirmation'=>'¿Está seguro de eliminar la venta en cuestión? NOTA:Se eliminarán completamente las cuentas pagadas/por pagar.',
                    'buttons'=>array(
                        'delete'=>array(
                            'label'=>'Eliminar/Cancelar'
                        )
                    )
		),
	),
)); ?>
