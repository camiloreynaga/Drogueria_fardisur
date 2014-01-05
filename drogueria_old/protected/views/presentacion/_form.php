<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'presentacion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'presentacion'); ?>
		<?php echo $form->textField($model,'presentacion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'presentacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nomeclatura'); ?>
		<?php echo $form->textField($model,'nomeclatura',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nomeclatura'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->