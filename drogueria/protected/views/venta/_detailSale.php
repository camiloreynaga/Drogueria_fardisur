<div>
    <?php 
    echo "<h1>Productos</div>";
    
    $producto=new Producto('search');
    $producto->descontinuado=0;
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'producto-grid',
            'dataProvider'=>$producto->search(),
            'filter'=>$producto,
            'ajaxUrl'=>array('Producto/search&id='.$venta->id.'&type=venta'),
            'columns'=>array(
                    //'tipo_producto',
                    array(
                            'name'=>'tipo_producto',
                            'value'=>'$data->tipo_producto0->tipo_producto',
                            'htmlOptions'=>array('style'=>'width: 115px;'),
                            'filter'=>CHtml::dropDownList('Producto[tipo_producto]', array(),CHtml::listData(Producto::model()->getListTipos_produtos(),'id','tipo_producto'),array('prompt'=>'-- Seleccione --'))                        
                    ),
                    'nombre_producto',
                    'concentracion',
                    array(
                            'name'=>'presentacion',
                            'value'=>'$data->presentacion0->presentacion',
                            'filter'=>CHtml::dropDownList('Producto[presentacion]',array(),CHtml::listData(Producto::model()->getListPresentacion(),'id_presentacion','presentacion'),array('prompt'=>'-- Seleccione --')),
                            'htmlOptions'=>array('style'=>'width: 115px;')
                    ),
                    //'presentacion',
                    array(
                            'name'=>'laboratorio',
                            'value'=>'$data->laboratorio0->laboratorio',
                            'filter'=>CHtml::dropDownList('Producto[id_laboratorio]',array(),CHtml::listData(Producto::model()->getListLaboratorio(),'id','laboratorio'),array('prompt'=>'-- Seleccione --')),
                            'htmlOptions'=>array('style'=>'width: 115px;')
                    ),
                    'stock',
                   array(         // display a column with "view", "update" and "delete" buttons
                    'class'=>'CButtonColumn',
                    'template'=>'{add}',
                    'buttons'=>array(
                        'add'=>array(
                            'label'=>'Agregar',
                            'url'=>'$this->grid->controller->createUrl("venta/addItem", array("idItem"=>$data->id,"idventa"=>'.$venta->id.'))',
                            'click'=>'function(){addItem($(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',

                            //'click'=>'addItem()'

                        )
                    )
               ),
            ),
    )); 
    echo "<h1>Productos seleccionados</h1>";
    $model=new Detalle_venta;
    $model->id_venta=$venta->id;
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'detalle-venta-grid',
            'dataProvider'=>$model->search(),
            'columns'=>array(
                    array(
                        'name'=>'producto',
                        'value'=>'$data->id_producto0->nombre_producto'
                    ),
                    array(
                        'name'=>'cantidad',
                        'value'=>'$data->cantidad'
                    ),
//                    array(
//                        'name'=>'Pre.',
//                        'value'=>'$data->presentacion0->presentacion'
//                    ),
                    array(
                        'name'=>'precio_unitario',
                        'value'=>'"S./ ".$data->precio_unitario'
                    ),
                    'lote',
                    array(
                      'name'=>'subtotal(valor venta)',
                      'value'=>'"S./ ".$data->subtotal'
                    ),
                    
			
                    //'fecha_vencimiento',
				/*
                    'ganancia',
                    */
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{delete}',
                        'buttons'=>array(
                            'delete'=>array(
                                'url'=>'Yii::app()->createUrl("venta/deleteItem", array("id"=>$data->id_detalle_venta,"idVenta"=>$data->id_venta))', //,"producto"=>$data->id_producto,"cantidad"=>$data->cantidad,"lote"=>$data->lote
                            )
                        ),
                        'deleteConfirmation'=>'Esta seguro de eliminar este item?',
                        'afterDelete'=>'function(link,success,data){ if(success) window.location.reload(); }',
                    ),
            ),
    )); ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
        'id'=>'cru-dialog',
        'options'=>array(
            'title'=>'Agregar Producto',
            'autoOpen'=>false,
            'modal'=>true,
            'width'=>550,
            'height'=>470,
        ),
    ));?>
    <div class="divForForm"></div>

    <?php $this->endWidget();
    $jsDialog="
    function addItem(url)
    {
        ".CHtml::ajax(array(
                'url'=>'js:url',
                'data'=> "js:$('.divForForm').find('form').serialize()",
                'type'=>'post',
                'dataType'=>'json',
                'success'=>"function(data)
                {
                    if (data.status == 'failure')
                    {
                        $('#cru-dialog div.divForForm').html(data.div);
                              // Here is the trick: on submit-> once again this function!
                        //$('#cru-dialog div.divForForm form').submit(addItem);
                    }
                    if(data.status == 'success')
                    {
                        $('#cru-dialog div.divForForm').html(data.div);
                        setTimeout(\"$('#cru-dialog').dialog('close') \",3000);
                        window.location.reload();
                    }
                    if(data.status == 'exist')
                    {
                        $('#cru-dialog div.divForForm').html(data.div);
                        setTimeout(\"$('#cru-dialog').dialog('close') \",3500);
                    }

                } ",
                ))."
        return false;
    }
    $('#cru-dialog').bind('dialogclose', function() {
        $('.form').html('');
    });
    $(document).ready(function(){
       $('#yt0').click(function(){
           if($('#detalle-venta-grid .items >tbody >tr .empty').length==1)
           {
               alert('Debe seleccionar almenos un producto..');
               return false;
           }
      });
     });
    ";
    Yii::app()->clientScript->registerScript('dialog', $jsDialog, CClientScript::POS_END);
    ?>
    <h1>Detalle de venta</h1>
    <div class="view" >
        <div class="left-column" style="padding-right: 75px;">
            <b><?php echo CHtml::encode($venta->getAttributeLabel('fecha_venta')); ?>:</b>
            <?php echo CHtml::encode($venta->fecha_venta); ?>
            <br />

            <b><?php echo CHtml::encode($venta->getAttributeLabel('id_proveedor')); ?>:</b>
            <?php echo CHtml::encode($venta->id_cliente0->nombre); ?>
            <br />
        </div>
        <div>
            <b><?php echo CHtml::encode($venta->getAttributeLabel('cantidad_cuotas')); ?>:</b>
            <?php echo CHtml::encode($venta->cantidad_cuotas); ?>
            <br />
            <b><?php echo CHtml::encode($venta->getAttributeLabel('total')); ?>:</b>
            <?php echo CHtml::encode('S./ '.$venta->Subtotal); //Subtotal porque la función devuelve el total ?>
            <br />
            <b><?php echo CHtml::encode($venta->getAttributeLabel('Subtotal')); ?>:</b>
            <?php echo CHtml::encode('S./ '.$venta->subtotal);//round(($venta->Total/1.18)*100)/100); ?>
            <br />
            <b><?php echo CHtml::encode($venta->getAttributeLabel('Impuesto')); ?>:</b>
            <?php echo CHtml::encode('S./ '.$venta->impuesto); //round(($venta->Total/1.18)*0.18*100)/100); ?>
        </div>    
        <div style="clear: both"></div>

    </div>
    <div class="row buttons">
         <?php echo CHtml::Button('Confirmar venta',
                 array(
                     'submit'=>array(
                         'venta/confirmarVenta','id'=>$venta->id,'updateStock'=>true
                         ),
                         'confirm'=>'Esta seguro de proceder con la venta?',
                     )
                 );
          //'return'=>'js:alert($(\'#detalle-venta-grid .items >tbody >tr\').length); return false;'?>
         <?php echo CHtml::ajaxButton('Cancelar venta',array('venta/delete','id'=>$venta->id, ),
                 array(
                      'type' => 'post',
                      'success'=>'function(data){location.href="'.CController::createUrl('venta/index').'"}'
                ),
                array(
                 'confirm'=>'Esta seguro de eliminar/cancelar la venta en proceso?',
             ));
         ?>
    </div>
</div>