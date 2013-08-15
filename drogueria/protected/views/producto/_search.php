<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_producto'); ?>
		<?php echo $form->textField($model,'tipo_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_producto'); ?>
		<?php echo $form->textField($model,'nombre_producto',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'concentracion'); ?>
		<?php echo $form->textArea($model,'concentracion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'presentacion'); ?>
		<?php echo $form->textField($model,'presentacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_laboratorio'); ?>
		<?php echo $form->textField($model,'id_laboratorio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_baja'); ?>
		<?php echo $form->textField($model,'fecha_baja'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'minimo_stock'); ?>
		<?php echo $form->textField($model,'minimo_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foto'); ?>
		<?php echo $form->textField($model,'foto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descontinuado'); ?>
		<?php echo $form->textField($model,'descontinuado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->