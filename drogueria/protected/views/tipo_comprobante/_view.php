<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_comprobante')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tipo_comprobante), array('view', 'id'=>$data->id_tipo_comprobante)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comprobante')); ?>:</b>
	<?php echo CHtml::encode($data->comprobante); ?>
	<br />


</div>