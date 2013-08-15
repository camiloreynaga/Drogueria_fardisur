<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Est� seguro de eliminar est� �tem?')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Ver Producto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                    'name'=>'tipo_producto',
                    'value'=>$model->tipo_producto0->tipo_producto
                ),
		'nombre_producto',
		'concentracion',
		array(
                    'name'=>'presentacion',
                    'value'=>$model->presentacion0->presentacion
                ),
		array(
                    'name'=>'id_laboratorio',
                    'value'=>$model->laboratorio0->laboratorio
                ),
		'fecha_registro',
		'minimo_stock',
                'stock',
		'foto',
		array(
                    'name'=>'descontinuado',
                    'value'=>$model->descontinuado==0?'No':'Si'
                ),
                array(
                    'name'=>'fecha_baja',
                    'visible'=>$model->descontinuado==1
                )
		,
		'observaciones',
	),
)); ?>
