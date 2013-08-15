<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'venta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cliente'); ?>
		<?php echo $form->dropDownList($model,'id_cliente', CHtml::listData($model->getListCliente(),'id','nombre'));
		//textField($model,'id_cliente'); ?>
		<?php echo $form->error($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_empleado'); ?>
		<?php echo $form->dropDownList($model,'id_empleado', CHtml::listData($model->getListEmpleado(),'id','nombre'));
		//textField($model,'id_empleado'); ?>
		<?php echo $form->error($model,'id_empleado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forma_envio'); ?>
		<?php echo $form->textField($model,'forma_envio',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'forma_envio'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'nro_factura'); ?>
		<?php echo $form->textField($model,'nro_factura',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nro_factura'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'forma_pago'); ?>
                <?php echo $form->dropDownList($model,'forma_pago', $model->TypePayment,array('prompt'=>'--Seleccione--'));?>
		<?php echo $form->error($model,'forma_pago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_cuotas'); ?>
		<?php echo $form->textField($model,'cantidad_cuotas'); ?>
		<?php echo $form->error($model,'cantidad_cuotas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear nueva venta' : 'Guardar cambios'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->