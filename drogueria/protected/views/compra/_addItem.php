<?php 

$producto=new Producto;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$producto->search(),
	'filter'=>$producto,
	'ajaxUpdate'=>'#divForForm',
	'columns'=>array(
		//'tipo_producto',
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
		array(
			'name'=>'laboratorio',
			'value'=>'$data->laboratorio0->laboratorio'
		),
		//'laboratorio',
		
		'descontinuado',
	),
)); ?>
