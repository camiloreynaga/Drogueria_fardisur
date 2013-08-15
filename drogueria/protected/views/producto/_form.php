<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'producto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos requeridos <span class="required">*</span></p>

	<?php echo $form->errorSummary($model); ?>
    <div class="left-column">
	<div class="row">
		<?php echo $form->labelEx($model,'tipo_producto'); ?>
		<?php echo $form->dropDownList($model,'tipo_producto', CHtml::listData($model->getListTipos_produtos(),'id','tipo_producto'),array('prompt'=>'-- Seleccione --')); //echo $form->dropDownList textField($model,'tipo_producto'); ?>
		<?php echo $form->error($model,'tipo_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_producto'); ?>
		<?php echo $form->textField($model,'nombre_producto',array('size'=>35,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'concentracion'); ?>
		<?php echo $form->textArea($model,'concentracion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'concentracion'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>
        
    </div>
    <div class="right-column">
        
	<div class="row">
		<?php echo $form->labelEx($model,'presentacion'); ?>
		<?php echo $form->dropDownList($model,'presentacion',CHtml::listData($model->getListPresentacion(),'id_presentacion','presentacion'),array('prompt'=>'-- Seleccione --')); ?>
		<?php echo $form->error($model,'presentacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'laboratorio'); ?>
		<?php echo $form->dropDownList($model,'id_laboratorio',CHtml::listData($model->getListLaboratorio(),'id','laboratorio'),array('prompt'=>'-- Seleccione --')); ?>
		<?php echo $form->error($model,'id_laboratorio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'minimo_stock'); ?>
		<?php echo $form->textField($model,'minimo_stock'); ?>
		<?php echo $form->error($model,'minimo_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->textField($model,'foto'); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descontinuado'); ?>
		<?php echo $form->checkbox($model,'descontinuado'); ?>
		<?php echo $form->error($model,'descontinuado'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio'); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

    </div>
    
    <div class="row buttons" style="clear:both;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar cambios'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->