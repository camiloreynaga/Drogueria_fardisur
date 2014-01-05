<div class="form">

        <h1>Detalle de Compra</h1>
        <div class="view" >
            <div class="left-column" style="padding-right: 75px;">
                <b><?php echo CHtml::encode($compra->getAttributeLabel('fecha_compra')); ?>:</b>
                <?php echo CHtml::encode($compra->fecha_compra); ?>
                <br />

                <b><?php echo CHtml::encode($compra->getAttributeLabel('id_proveedor')); ?>:</b>
                <?php echo CHtml::encode($compra->id_proveedor0->nombre_proveedor); ?>
                <br />

                <b><?php echo CHtml::encode($compra->getAttributeLabel('nro_factura')); ?>:</b>
                <?php echo CHtml::encode($compra->nro_factura); ?>
                <br />

                <b><?php echo CHtml::encode($compra->getAttributeLabel('almacen')); ?>:</b>
                <?php echo CHtml::encode($compra->almacen0->almacen); ?>
                <br />

                <b><?php echo CHtml::encode($compra->getAttributeLabel('observaciones')); ?>:</b>
                <?php echo CHtml::encode($compra->observaciones); ?>
                <br/>
            </div>
            <div>
                <b><?php echo CHtml::encode($compra->getAttributeLabel('cantidad_cuotas')); ?>:</b>
                <?php echo CHtml::encode($compra->cantidad_cuotas); ?>
                <br />
                <b><?php echo CHtml::encode($compra->getAttributeLabel('Subtotal')); ?>:</b>
                <?php echo CHtml::encode('S./ '.$compra->subTotal); ?>
                <br />
                <b><?php echo CHtml::encode($compra->getAttributeLabel('Impuesto')); ?>:</b>
                <?php echo CHtml::encode('S./ '.$compra->impuesto); ?>
                <br />
                <b><?php echo CHtml::encode($compra->getAttributeLabel('Total')); ?>:</b>
                <?php echo CHtml::encode('S./ '.$compra->total); ?>
            </div>    
            <div style="clear: both"></div>

        </div>
        
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-pagar-form',
	'enableAjaxValidation'=>false,
        'action'=>array('compra/confirmarCompra','id'=>$compra->id)
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
        $criteria->compare('compra',$compra->id);
        
        $dataProvider=new CActiveDataProvider('Cuenta_pagar',array('criteria'=>$criteria));
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'cuenta-pagar-grid',
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
                        //'interes',
                        array(
                                'class'=>'CButtonColumn',
                                'template'=>'{delete}',
                                'buttons'=>array(
                                    'delete'=>array(
                                        'url'=>'Yii::app()->createUrl("compra/deleteCuota", array("id"=>$data->idcuenta_pagar))',
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
                     'compra/finalizarCompra','id'=>$compra->id
                     ),
                     'confirm'=>'Esta seguro de proceder con la compra?',
                 )
             );?>
                    
</div>