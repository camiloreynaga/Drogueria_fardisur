<?php
$this->breadcrumbs=array(
	'Ventas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Venta', 'url'=>array('index')),
	array('label'=>'Administrar Ventas', 'url'=>array('admin')),
        array('label'=>'Nuevo Cliente','url'=>array('cliente/create'))
);
?>

<h1>Nueva Venta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>