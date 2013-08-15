<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'compra-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Campos requeridos<span class="required">*</span>.</p>
   
	<?php echo $form->errorSummary($model); ?>
   
    <div class="left-column">
	<div class="row">
		<?php echo $form->labelEx($model,'fecha_compra',array('style'=>'float:left;padding-right:15px;')); ?>
		<?php //echo CHtml::encode($model->fecha_compra);
                      //echo $form->hiddenField($model,'fecha_compra');
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'fecha_compra',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd'
                    ),
                    'language'=>'es',
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                )); ?>
		<?php echo $form->error($model,'fecha_compra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nro_factura',array('style'=>'float:left;padding-right:15px;')); ?>
                <?php echo $form->textField($model,'nro_factura'); ?>
		<?php echo $form->error($model,'nro_factura'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>30)); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>
    
    </div>
    <div class="right-column">
        
        <div class="row">
		<?php echo $form->labelEx($model,'id_proveedor'); ?>
		<?php echo $form->dropDownList($model,'id_proveedor', CHtml::listData($model->getListProveedor(),'id','nombre_proveedor'),array('prompt'=>'-- Seleccione --'));
		//textField($model,'id_proveedor'); ?>
		<?php echo $form->error($model,'id_proveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_cuotas'); ?>
		<?php echo $form->textField($model,'cantidad_cuotas'); ?>
		<?php echo $form->error($model,'cantidad_cuotas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'almacen'); ?>
		<?php echo $form->dropDownList($model,'almacen', CHtml::listData($model->getListAlmacen(),'id_almacen','almacen'),array('prompt'=>'-- Seleccione --'));
		//textField($model,'almacen'); ?>
		<?php echo $form->error($model,'almacen'); ?>
	</div>
    </div>
	
	<div class="row buttons" style="clear:both">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear compra' : 'Guardar cambios'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->