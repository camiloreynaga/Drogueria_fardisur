<?php $this->pageTitle=Yii::app()->name; 
if(Yii::app()->user->name=='admin')
{
    $productos=Producto::model()->checkStock();
    if(count($productos)>0)
    {
        $dataProvider=new CArrayDataProvider($productos, array(
            'id'=>'producto',
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        echo "<div><h2>Productos con Stock al límite</h2></div>";

        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_altert_product',   // refers to the partial view named '_post'

        ));
    }
    $criteria=new CDbCriteria;
    $criteria->addCondition('fecha_pago>=:fecha_pago AND estado=0');
    $criteria->params=array(':fecha_pago'=>new CDbExpression('NOW()'));
    
    //$dataProvider=Cuenta_cobrar::model()->findAll('fecha_pago<=:fecha_pago',array(':fecha_pago'=>new CDbExpression('NOW()')));
    unset($dataProvider);
    $dataProvider=new CActiveDataProvider('Cuenta_cobrar',
            array(
                'criteria'=>$criteria
        )
    );
    
    if($dataProvider->totalItemCount>0)
    {
       $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_altert_payment',
            'summaryText'=>false,
            'emptyText'=>''
        ));
       
    }
}
?>
