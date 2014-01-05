<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->id_proveedor0->nombre_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_factura')); ?>:</b>
	<?php echo CHtml::encode($data->nro_factura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_cuotas')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_cuotas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('almacen')); ?>:</b>
	<?php echo CHtml::encode($data->almacen0->almacen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />


</div>