<?php

/**
 * This is the model class for table "detalle_venta".
 *
 * The followings are the available columns in table 'detalle_venta':
 * @property integer $id_detalle_venta
 * @property integer $id_venta
 * @property integer $id_producto
 * @property string $lote
 * @property integer $cantidad
 * @property string $precio_unitario
 */
class Detalle_venta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detalle_venta the static model class
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
		return 'detalle_venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_venta, id_producto, cantidad', 'required'),
			array('id_venta, id_producto, cantidad', 'numerical', 'integerOnly'=>true),
			array('lote', 'length', 'max'=>50),
			array('precio_unitario', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_detalle_venta, id_venta, id_producto, lote, cantidad, precio_unitario', 'safe', 'on'=>'search'),
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
			'id_producto0' => array(self::BELONGS_TO, 'Producto', 'id_producto'),
			'id_venta0' => array(self::BELONGS_TO, 'Venta', 'id_venta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detalle_venta' => 'Id Detalle Venta',
			'id_venta' => 'Id Venta',
			'id_producto' => 'Id Producto',
			'lote' => 'Lote',
			'cantidad' => 'Cantidad',
			'precio_unitario' => 'Precio Unitario',
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

		$criteria->compare('id_detalle_venta',$this->id_detalle_venta);

		$criteria->compare('id_venta',$this->id_venta);

		$criteria->compare('id_producto',$this->id_producto);

		$criteria->compare('lote',$this->lote,true);

		$criteria->compare('cantidad',$this->cantidad);

		$criteria->compare('precio_unitario',$this->precio_unitario,true);

		return new CActiveDataProvider('Detalle_venta', array(
			'criteria'=>$criteria,
		));
	}
        // muestra lo lotes disponibles filtrados por prducto 
        public function getListLote($id_producto)
	{
		$criteria = new CDbCriteria();
		$criteria->select='lote';
                $criteria->compare('producto',$id_producto);
                $criteria->addCondition('cantidad_disponible > 0');
                
		return Detalle_compra::model()->findAll($criteria);
		
	}
        
        //muestra la cantidad de disponible de un lote
        public function getStockAvailable($id_producto,$lote)
        {
            $criteria = new CDbcriteria();
            $criteria->select='cantidad_disponible';
            $criteria->condition='producto='.$id_producto.' and lote='.$lote;
        }
}