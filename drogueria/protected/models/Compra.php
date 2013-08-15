<?php

/**
 * This is the model class for table "compra".
 *
 * The followings are the available columns in table 'compra':
 * @property integer $id
 * @property string $fecha_compra
 * @property integer $id_proveedor
 * @property string $nro_factura
 * @property integer $cantidad_cuotas
 * @property integer $almacen
 * @property string $observaciones
 */
class Compra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Compra the static model class
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
		return 'compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_proveedor, almacen, nro_factura', 'required'),
			array('id_proveedor, cantidad_cuotas, almacen', 'numerical', 'integerOnly'=>true),
			array('nro_factura', 'length', 'max'=>50),
			array('fecha_compra, observaciones', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_compra, id_proveedor, nro_factura, cantidad_cuotas, almacen, observaciones', 'safe', 'on'=>'search'),
                        array('fecha_compra', 'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
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
			'id_proveedor0' => array(self::BELONGS_TO, 'Proveedor', 'id_proveedor'),
			'almacen0' => array(self::BELONGS_TO, 'Almacen', 'almacen'),
			'cuenta_pagars' => array(self::HAS_MANY, 'Cuenta_pagar', 'compra'),
			'detalle_compras' => array(self::HAS_MANY, 'Detalle_compra', 'id_compra'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'fecha_compra' => 'Fecha Compra',
			'id_proveedor' => 'Proveedor',
			'nro_factura' => 'Nro Factura',
			'cantidad_cuotas' => 'Cantidad Cuotas',
			'almacen' => 'Almacen',
			'observaciones' => 'Observaciones',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fecha_compra',$this->fecha_compra,true);
		$criteria->compare('id_proveedor',$this->id_proveedor);
		$criteria->with=array('id_proveedor0');
		$criteria->compare('nro_factura',$this->nro_factura,true);
		$criteria->compare('cantidad_cuotas',$this->cantidad_cuotas);
		$criteria->compare('almacen',$this->almacen);
		$criteria->with=array('almacen0');

		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider('Compra', array(
			'criteria'=>$criteria,
		));
	}
	//Llenado de Combos
	public function getListProveedor()
	{
		$criteria = new CDbCriteria();
		$criteria->order='nombre_proveedor';
		return Proveedor::model()->findAll($criteria);
		
	}
	
	public function getListAlmacen()
	{
		$criteria = new CDbCriteria();
		$criteria->order='almacen';
		return Almacen::model()->findAll($criteria);
		
	}
        
        //listar Almacenes Ciudades
	public function getListCiudad()
	{
		$criteria = new CDbCriteria();
		//$criteria->order='ciudad';
                $criteria->select='select ciudad from cliente';
                $criteria->group='ciudad';
                //$criteria->
		return Cliente::model()->findAll($criteria);
		
	}
        
              
        public function getsubTotal()
        {
            $total=0.0;
            
            foreach($this->detalle_compras as $detalle)
            {
                $total+=(($detalle->cantidad*$detalle->precio_unitario)*100)/100;
            }
            $this->impuesto=$total*((int)Yii::app()->params['impuesto']*0.01);
            $this->total=$total+$this->impuesto;
            $this->subtotal=$total;
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
            foreach($this->cuenta_pagars as $cuenta)
            {
                $total+=$cuenta->monto;
            }
            return $total;
        }
        //actualiza el stock del cada producto
        public function updateStock()
        {
//            foreach($this->detalle_compras as $detalle)
//            {
//                $producto= Producto::model()->findByPk($detalle->producto);
//                $producto->stock+=$detalle->cantidad;
//                $producto->save();
//            }
        }
        public function deleteDetaills()
        {
            $detalles=$this->detalle_compras;
            foreach($detalles as $detalle)
            {
                $product=Producto::model()->findByPk($detalle->producto);
                if(isset($product))
                {
                    $product->stock-=$detalle->cantidad;
                    $product->save();
                }
                
                /*$detalleCompra=Detalle_compra::model()->find(
                        'producto=:producto and lote=:lote',
                        array(
                            ':lote'=>$detalle->lote,
                            ':producto'=>$product->id
                        ));
                if(isset($detalleCompra))
                {
                    $detalleCompra->cantidad+=$detalle->cantidad;
                    $detalleCompra->save();
                }*/
            }
            Cuenta_pagar::model()->deleteAll('compra=:compra',array(':compra'=>$this->id));
            Detalle_compra::model()->deleteAll('id_compra=:id_compra',array(':id_compra'=>$this->id));
        }
}