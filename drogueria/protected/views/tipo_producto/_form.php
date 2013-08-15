<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-producto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_producto'); ?>
		<?php echo $form->textField($model,'tipo_producto',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'tipo_producto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->