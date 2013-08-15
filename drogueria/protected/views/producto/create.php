<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
        array('label'=>'Nuevo Laboratorio','url'=>array('laboratorio/create')),
        array('label'=>'Nueva Presentacion','url'=>array('presentacion/create')),
        array('label'=>'Nueva Tipo Producto','url'=>array('tipo_producto/create'))
);
?>

<h1>Crear Producto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>