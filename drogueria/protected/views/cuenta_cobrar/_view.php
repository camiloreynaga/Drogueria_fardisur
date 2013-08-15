<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcuenta_cobrar')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcuenta_cobrar), array('view', 'id'=>$data->idcuenta_cobrar)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('venta')); ?>:</b>
	<?php echo CHtml::encode($data->venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />


</div>