<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'almacen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'almacen'); ?>
		<?php echo $form->textField($model,'almacen',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'almacen'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->