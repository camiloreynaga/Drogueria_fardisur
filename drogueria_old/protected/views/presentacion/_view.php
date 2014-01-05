<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_presentacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_presentacion), array('view', 'id'=>$data->id_presentacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presentacion')); ?>:</b>
	<?php echo CHtml::encode($data->presentacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomeclatura')); ?>:</b>
	<?php echo CHtml::encode($data->nomeclatura); ?>
	<br />


</div>