<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcomprobante_pago')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcomprobante_pago), array('view', 'id'=>$data->idcomprobante_pago)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('venta')); ?>:</b>
	<?php echo CHtml::encode($data->venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serie')); ?>:</b>
	<?php echo CHtml::encode($data->serie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />


</div>