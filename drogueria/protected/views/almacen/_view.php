<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_almacen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_almacen), array('view', 'id'=>$data->id_almacen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('almacen')); ?>:</b>
	<?php echo CHtml::encode($data->almacen); ?>
	<br />


</div>