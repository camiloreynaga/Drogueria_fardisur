<?php
if($_GET['type']=='compra')
{
    $id="idCompra";
    $url='compra/addItem';
}
else
{
    $url='venta/addItem';
    $id="idventa";
}

    $producto->descontinuado=0;
    $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'producto-grid',
            'dataProvider'=>$producto->search('venta'),
            'filter'=>$producto,
            'ajaxUrl'=>array('Producto/search&id='.$_GET['id']),
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
                'stock',
                   array(         // display a column with "view", "update" and "delete" buttons
                    'class'=>'CButtonColumn',
                    'template'=>'{add}',
                    'buttons'=>array(
                        'add'=>array(
                            'label'=>'Agregar',
                            'url'=>'$this->grid->controller->createUrl("'.$url.'", array("idItem"=>$data->id,"'.$id.'"=>'.$_GET['id'].'))',
                            'click'=>'function(){addItem($(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',

                            //'click'=>'addItem()'

                        )
                    )
               ),
            ),
    ));  ?>