<div>
<?php 
echo "<h1>Productos</div>";
$producto=new Producto('search');
$producto->descontinuado=0;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'producto-grid',
	'dataProvider'=>$producto->search(),
	'filter'=>$producto,
	'ajaxUrl'=>array('Producto/search&id='.$compra->id.'&type=compra'),
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
			'name'=>'id_laboratorio',
			'value'=>'$data->laboratorio0->laboratorio',
                        'filter'=>CHtml::dropDownList('Producto[id_laboratorio]',array(),CHtml::listData($producto->ListLaboratorio,'id','laboratorio'),array('prompt'=>'-- Seleccione --')),
                        'htmlOptions'=>array('style'=>'width: 115px;')
		),
               array(         // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'template'=>'{add}',
                'buttons'=>array(
                    'add'=>array(
                        'label'=>'Agregar',
                        'url'=>'$this->grid->controller->createUrl("compra/addItem", array("idItem"=>$data->id,"idCompra"=>'.$compra->id.'))',
                        'click'=>'function(){addItem($(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                        
                        //'click'=>'addItem()'
                        
                    )
                )
           ),
	),
)); 
echo "<h1>Productos seleccionados</h1>";
$model=new Detalle_compra;
$model->id_compra=$compra->id;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detalle-compra-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
                    'name'=>'producto',
                    'value'=>'$data->producto0->nombre_producto'
                ),
		array(
                    'name'=>'cantidad',
                    'value'=>'$data->cantidad." (und)"'
                ),
		array(
                    'name'=>'precio_unitario',
                    'value'=>'"S./ ".$data->precio_unitario'
                ),
		'lote',
                array(
                  'name'=>'subtotal',
                  'value'=>'"S./ ".$data->subtotal'
                ),
		
		'fecha_vencimiento',
		//'ganancia',
		
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}',
                    'buttons'=>array(
                        'delete'=>array(
                            'url'=>'Yii::app()->createUrl("compra/deleteItem", array("id"=>$data->id_detalle_compra))',
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
       if($('#detalle-compra-grid .items >tbody >tr .empty').length==1)
       {
           alert('Debe seleccionar almenos un producto..');
           return false;
       }
  });
 });
";
Yii::app()->clientScript->registerScript('dialog', $jsDialog, CClientScript::POS_END);
?>
<h1>Detalle de Compra</h1>
<div class="view" >
    <div class="left-column" style="padding-right: 75px;height: 70px;">
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
<div class="row buttons">
     <?php echo CHtml::Button('Confirmar compra',
             array(
                 'submit'=>array(
                     'compra/confirmarCompra','id'=>$compra->id,'updateStock'=>true
                     ),
                     'confirm'=>'Esta seguro de proceder con la compra?',
                 )
             );
     echo CHtml::ajaxButton('Cancelar compra',array('compra/delete','id'=>$compra->id),
                 array(
                      'type' => 'post',
                      'success'=>'function(data){location.href="'.CController::createUrl('compra/admin').'"}'
                ),
             array(
                 'confirm'=>'Esta seguro de eliminar/cancelar la compra en proceso?',
             ));
         ?>
                    
</div>