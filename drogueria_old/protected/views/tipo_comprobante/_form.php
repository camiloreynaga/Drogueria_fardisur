<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-comprobante-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comprobante'); ?>
		<?php echo $form->textField($model,'comprobante',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'comprobante'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->