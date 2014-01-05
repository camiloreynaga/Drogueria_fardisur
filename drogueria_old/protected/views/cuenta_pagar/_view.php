<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcuenta_pagar')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcuenta_pagar), array('view', 'id'=>$data->idcuenta_pagar)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('compra')); ?>:</b>
	<?php echo CHtml::encode($data->compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interes')); ?>:</b>
	<?php echo CHtml::encode($data->interes); ?>
	<br />


</div>