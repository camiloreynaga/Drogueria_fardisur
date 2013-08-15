<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('producto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Productos</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'name'=>'tipo_producto',
                    'value'=>'$data->tipo_producto0->tipo_producto'
                ),
                'nombre_producto',
                'concentracion',
		array(
                    'name'=>'presentacion',
                    'value'=>'$data->presentacion0->presentacion'
                ),
		//'presentacion',
		array (
                    'name'=>'id_laboratorio',
                    'value'=>'$data->laboratorio0->laboratorio'
                ),
		//'laboratorio',
                'minimo_stock',
                'stock',
//                array(
//                'name'=>'descontinuado',
//                'filter'=>'',
//                'value'=>'$data->descontinuado==0?"No":"Si"'
//                ),		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
