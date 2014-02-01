<?php

/**
 * This is the model class for table "venta".
 *
 * The followings are the available columns in table 'venta':
 * @property integer $id
 * @property integer $id_cliente
 * @property integer $id_empleado
 * @property string $fecha_venta
 * @property string $forma_envio
 * @property string $forma_pago
 * @property integer $cantidad_cuotas
 */
class Venta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Venta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cliente, id_empleado, forma_pago', 'required'),
			array('id_cliente, id_empleado, cantidad_cuotas', 'numerical', 'integerOnly'=>true),
			array('forma_envio, forma_pago', 'length', 'max'=>50),
			array('fecha_venta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_cliente, id_empleado, fecha_venta, forma_envio, forma_pago, cantidad_cuotas', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comprobante_pagos' => array(self::HAS_MANY, 'ComprobantePago', 'venta'),
			'cuenta_cobrars' => array(self::HAS_MANY, 'Cuenta_cobrar', 'venta'),
			'detalle_ventas' => array(self::HAS_MANY, 'Detalle_venta', 'id_venta'),
			'id_cliente0' => array(self::BELONGS_TO, 'Cliente', 'id_cliente'),
			'id_empleado0' => array(self::BELONGS_TO, 'Empleado', 'id_empleado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
                        'nro_factura'=>'Nro Factura',
			'id_cliente' => 'Id Cliente',
			'id_empleado' => 'Id Empleado',
			'fecha_venta' => 'Fecha Venta',
			'forma_envio' => 'Forma Envio',
			'forma_pago' => 'Forma Pago',
			'cantidad_cuotas' => 'Cantidad Cuotas',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->alias='venta';

		$criteria->compare('venta.id',$this->id);

		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->with=array('id_cliente0');

		$criteria->compare('id_empleado',$this->id_empleado);
		
		$criteria->with=array('id_empleado0');

		$criteria->compare('fecha_venta',$this->fecha_venta,true);

		$criteria->compare('forma_envio',$this->forma_envio,true);

		$criteria->compare('forma_pago',$this->forma_pago,true);

		$criteria->compare('cantidad_cuotas',$this->cantidad_cuotas);

		return new CActiveDataProvider('Venta', array(
			'criteria'=>$criteria,
		));
	}
	
	public function getListCliente()
	{
		$criteria = new CDbCriteria();
		$criteria->order='nombre';
		return  Cliente::model()->findAll($criteria);
		
	}
	
	public function getListEmpleado()
	{
		$criteria = new CDbCriteria();
		$criteria->order='nombre';
		return  Empleado::model()->findAll($criteria);
		
	}
        
        public function getFormaPago()
        {
            $rpta=array(
                'contado'=>'Al contado',
                'tarjeta'=>'Tarjeta',
                'partes'=>'Partes (crédito)'
                );
            return $rpta;
        }
//        public function getTotal()
//        {
//            $total=0.0;
//            
//            foreach($this->detalle_ventas as $detalle)
//            {
//                $total+=(($detalle->cantidad*$detalle->precio_unitario)*100)/100;
//            }
//            $this->total=$total+$this->impuesto;
//            $this->save();
//            return $total;
//        }
        
        public function getsubTotal()
        {
            $total=0.0;
            
            foreach($this->detalle_ventas as $detalle)
            {
                //$total+=round(($detalle->cantidad*$detalle->precio_unitario)*100)/100;
                $total+=(($detalle->cantidad*$detalle->precio_unitario)*100)/100;
            }
            $this->impuesto=  round(($total/1.18)*0.18*100)/100; //$total*((int)Yii::app()->params['impuesto']*0.01);
            $this->total= ($total*100)/100;
            $this->subtotal= round(($total/1.18)*100)/100;//-$this->impuesto;  round(($venta->Total/1.18)*100)/100)
            $this->save();
            return $total;
        }
        public function getImpuesto()
        {
            $impuesto=0.0;
            
        }
        
        public function getTotalCuotas()
        {
            $total=0.0;
            foreach($this->cuenta_cobrars as $cuenta)
            {
                $total+=$cuenta->monto;
            }
            return $total;
        }
        
        public function updateTotal()
        {
            $this->impuesto=$this->subTotal*((int)Yii::app()->params['impuesto']*0.01);
            $this->total=$this->subTotal+$this->impuesto;
        }
        
        //actualiza el stock del cada producto
        public function updateStock()
        {
//            foreach($this->detalle_ventas as $detalle)
//            {
//                $producto= Producto::model()->findByPk($detalle->id_producto);
//                $producto->stock-=$detalle->cantidad;
//                $producto->save();
//            }
        }
        //actualiza cantidad en cada compra_detalle
        public function updateCantidad($idProducto,$cantidad,$lote)
        {
            //
            $rows=Detalle_compra::model()->count('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
            //
            if($rows>1)
            {
                $tmp=Detalle_compra::model()->findAll('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
                foreach ($tmp as $value) {
                    if($value->cantidad_disponible<$cantidad)
                    {
                        $cantidad-=$value->cantidad_disponible;
                        $value->cantidad_disponible=0;
                    }
                    else        
                        if ($cantidad>0)
                        {
                        $value->cantidad_disponible-=$cantidad;
                        $cantidad -=$value->cantidad_disponible;
                        }
                  $value->save(); 
                }
            }
            else
            {
                $tmp=Detalle_compra::model()->find('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
                $tmp->cantidad_disponible-=$cantidad;
                $tmp->save();
            }
        }
        
        public function restoreCantidad($idProducto,$cantidad,$lote)
        {
            $rows=Detalle_compra::model()->count('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
            //
            if($rows>1)
            {
                $tmp=Detalle_compra::model()->findAll('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
                foreach ($tmp as $value) {
                    if($cantidad>0)
                    {
                        $Reponer=$value->cantidad-$value->cantidad_disponible;
                        //$Reponer=$cantidad;
                        if($Reponer<=$cantidad)
                        {
                             $value->cantidad_disponible+=$Reponer;
                            $cantidad-=$Reponer;
                        }
                        else
                        {
                            $value->cantidad_disponible+=$cantidad;
                            $cantidad-=$Reponer;
                        }
                            
                    }
                    
                  $value->save(); 
                }
            }
            else
            {
                $tmp=Detalle_compra::model()->find('producto=:id_producto and lote=:lote',array(':id_producto'=>$idProducto,':lote'=>$lote));
                $tmp->cantidad_disponible+= $cantidad; //aquí se modifico cantidad por cantidad_disponible
                $tmp->save();
            }
        }
        
        public function getTypePayment()
        {
            $response=array(
                'credito'=>'Crédito',//'credit'=>'Crédito',
                'contado'=>'Contado',//'cash'=>'Contado',
                'letra'=>'Letra'//'letter'=>'Letra'
                );
            return empty($this->forma_pago)?$response:$response[$this->forma_pago];
        }
        
        public function deleteDetaills()
        {
            $detalles=$this->detalle_ventas;
            foreach($detalles as $detalle)
            {
                $product=Producto::model()->findByPk($detalle->id_producto);
                if(isset($product))
                {
                   // $product->stock+=$detalle->cantidad;
                    $product->save();
                }
                
                $detalleCompra=Detalle_compra::model()->find(
                        'producto=:producto and lote=:lote',
                        array(
                            ':lote'=>$detalle->lote,
                            ':producto'=>$product->id
                        ));
                if(isset($detalleCompra))
                {
                    $this->restoreCantidad($detalleCompra->producto,$detalle->cantidad,$detalleCompra->lote);
//                    $detalleCompra->cantidad_disponible+=$detalle->cantidad;
//                    $detalleCompra->save();
                }
            }
            Cuenta_cobrar::model()->deleteAll('venta=:venta',array(':venta'=>$this->id));
            Detalle_venta::model()->deleteAll('id_venta=:id_venta',array(':id_venta'=>$this->id));
        }
}