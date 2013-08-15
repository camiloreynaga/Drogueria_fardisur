<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-compra-form',
	'enableAjaxValidation'=>false,
        'action'=>$this->createUrl('compra/addItem',array('idItem'=>$model->producto,'idCompra'=>$model->id_compra)),
        'method'=>'post'
)); ?>

	<p class="note">Campos requeridos <span class="required">*</span>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'id_compra'); ?>
		<?php echo $form->hiddenField($model,'id_compra'); ?>
		<?php echo $form->error($model,'id_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'producto',array('style'=>'padding-right:75px;float:left;')); ?>
                <?php echo Chtml::encode($model->producto0->nombre_producto); ?>
		<?php echo $form->hiddenField($model,'producto'); ?>
		<?php echo $form->error($model,'producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad',array('style'=>'padding-right:90px;float:left;')); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio_unitario',array('style'=>'padding-right:43px;float:left;')); ?>
		<?php echo $form->textField($model,'precio_unitario',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'precio_unitario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lote',array('style'=>'padding-right:125px;float:left;')); ?>
		<?php echo $form->textField($model,'lote',array('maxlength'=>50)); ?>
		<?php echo $form->error($model,'lote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_vencimiento',array('style'=>'padding-right:15px;float:left;')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'attribute'=>'fecha_vencimiento',
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd'
                                //'language'=>'es',
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;'
                            ),
                        ));
                //echo $form->textField($model,'fecha_vencimiento'); ?> 
		<?php echo $form->error($model,'fecha_vencimiento'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $("#detalle-compra-form").submit(function(){addItem($('#detalle-compra-form').attr('action'));return false;});
</script>