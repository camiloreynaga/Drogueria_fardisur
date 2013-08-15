<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalle-venta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos requeridos <span class="required">*</span>.</p>

	<?php echo $form->errorSummary($model);?>

	<div class="row">
		<?php echo $form->hiddenField($model,'id_venta'); ?>
		<?php echo $form->error($model,'id_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Producto'); ?>
                <?php echo $form->hiddenField($model,'id_producto'); ?>
		<?php echo $model->id_producto0->nombre_producto; ?>
		<?php echo $form->error($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lote'); ?>
                <?php echo $form->dropDownList($model,'lote', CHtml::listData($model->getListLote($model->id_producto0->id),'lote','lote'),
                      array('prompt'=>'-- Seleccione --',
                            'ajax'=>array (
                                'url'=>CController::createUrl('venta/TotalByLote'),
                                'update'=>'#lote',
                                'data'=>array('id'=>'js:$("#Detalle_venta_lote").val()','producto'=>'js:$("#Detalle_venta_id_producto").val()'),
                            ),
                          )); //echo $form->dropDownList textField($model,'tipo_producto'); 
                echo "<div id='lote'></div>";
                ?>
		<?php //echo "cantidad disponible ". $model->getStockAvailable($model->id_producto->id,$model->lote); //echo $form->textField($model,'lote',array('size'=>50,'maxlength'=>50)); ?>
                <?php echo $form->error($model,'lote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad'); ?>
		<?php echo $form->textField($model,'cantidad'); ?>
                <?php //echo  ?>
		<?php echo $form->error($model,'cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio_unitario'); ?>
		<?php echo $form->textField($model,'precio_unitario',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'precio_unitario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $("#detalle-venta-form").submit(function(){addItem($('#detalle-venta-form').attr('action'));return false;});
</script>