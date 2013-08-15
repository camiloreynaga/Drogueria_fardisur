<div class="form">

        <h1>Detalle de Venta</h1>
        <div class="view" >
            <div class="left-column" style="padding-right: 75px;">
                <b><?php echo CHtml::encode($venta->getAttributeLabel('fecha_compra')); ?>:</b>
                <?php echo CHtml::encode($venta->fecha_venta); ?>
                <br />

                <b><?php echo CHtml::encode($venta->getAttributeLabel('id_cliente')); ?>:</b>
                <?php echo CHtml::encode($venta->id_cliente0->nombre); ?>
                <br />

                <b><?php echo CHtml::encode($venta->getAttributeLabel('nro_factura')); ?>:</b>
                <?php echo CHtml::encode($venta->nro_factura); ?>
                <br />
               
            </div>
            <div>
                <b><?php echo CHtml::encode($venta->getAttributeLabel('cantidad_cuotas')); ?>:</b>
                <?php echo CHtml::encode($venta->cantidad_cuotas); ?>
                <br />
                <b><?php echo CHtml::encode($venta->getAttributeLabel('Subtotal')); ?>:</b>
                <?php echo CHtml::encode('S./ '.round(($venta->SubTotal/1.18)*100)/100); // .$venta->subTotal); ?>
                <br />
                <b><?php echo CHtml::encode($venta->getAttributeLabel('Impuesto')); ?>:</b>
                <?php echo CHtml::encode('S./ '.round(($venta->SubTotal/1.18)*0.18*100)/100); //impuesto); ?>
                <br />
                <b><?php echo CHtml::encode($venta->getAttributeLabel('Total')); ?>:</b>
                <?php echo CHtml::encode('S./ '.$venta->Subtotal);// total); ?>
            </div>    
            <div style="clear: both"></div>

        </div>
        
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-cobrar-form',
	'enableAjaxValidation'=>false,
        'action'=>array('venta/confirmarventa','id'=>$venta->id)
        )); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'monto'); ?>
		<?php echo $form->textField($model,'monto',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'monto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_vencimiento'); ?>
		<?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'fecha_vencimiento',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd'
                    ),
                    'language'=>'es',
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));?>
		<?php echo $form->error($model,'fecha_vencimiento'); ?>
	</div>
        
        <div class="row buttons">
		<?php echo CHtml::submitButton('Agregar'); ?>
	</div>

<?php $this->endWidget(); ?>
        <?php 
        $criteria= new CDbCriteria;
        $criteria->compare('venta',$venta->id);
        
        $dataProvider=new CActiveDataProvider('Cuenta_cobrar',array('criteria'=>$criteria));
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'cuenta-cobrar-grid',
                'dataProvider'=>$dataProvider,
                //'filter'=>$model,
                'columns'=>array(
                        'monto',
                        array(
                                'name'=>'estado',
                                'type'=>'raw',
                                'value'=>'$data->estado==0?"Pendiente":"Pagado"'
                            ),
                        'fecha_vencimiento',
                       // 'interes',
                        array(
                                'class'=>'CButtonColumn',
                                'template'=>'{delete}',
                                'buttons'=>array(
                                    'delete'=>array(
                                        'url'=>'Yii::app()->createUrl("venta/deleteCuota", array("id"=>$data->idcuenta_cobrar))',
                                    )
                                ),
                            
                        ),
                ),
        )); ?>

</div><!-- form -->
<div class="row buttons">
     <?php echo CHtml::Button('Finalizar',
             array(
                 'submit'=>array(
                     'venta/finalizarventa','id'=>$venta->id
                     ),
                     'confirm'=>'Esta seguro de proceder con la venta?',
                 )
             );
    
     ?>
    
                    
</div>