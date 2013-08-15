<?php

/**
 * This is the model class for table "detalle_compra".
 *
 * The followings are the available columns in table 'detalle_compra':
 * @property integer $id_detalle_compra
 * @property integer $id_compra
 * @property integer $producto
 * @property integer $cantidad
 * @property integer $cantidad_disponible
 * @property string $precio_unitario
 * @property string $lote
 * @property string $fecha_vencimiento
  */
class Detalle_compra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detalle_compra the static model class
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
		return 'detalle_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('id_compra, producto', 'required'),
			array('id_compra, producto, cantidad, cantidad_disponible, precio_unitario, lote, fecha_vencimiento', 'required','on'=>'create'),
			array('id_compra, producto, cantidad', 'numerical', 'integerOnly'=>true),
			array('precio_unitario', 'length', 'max'=>10),
			array('lote', 'length', 'max'=>50),
			array('fecha_vencimiento', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_detalle_compra, id_compra, producto, cantidad, precio_unitario, lote, fecha_vencimiento', 'safe', 'on'=>'search'),
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
			'id_compra0' => array(self::BELONGS_TO, 'Compra', 'id_compra'),
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detalle_compra' => 'Id',
			'id_compra' => 'Compra',
			'producto' => 'Producto',
			'cantidad' => 'Cantidad',
                        //'cantidad_disponible'=>'Cantidad Disponible',
			'precio_unitario' => 'Precio Unitario',
			'lote' => 'Lote',
			'fecha_vencimiento' => 'Fecha Vencimiento',
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

		$criteria->compare('id_detalle_compra',$this->id_detalle_compra);

		$criteria->compare('id_compra',$this->id_compra);

		$criteria->compare('producto',$this->producto);

		$criteria->compare('cantidad',$this->cantidad);
                
                //$criteria->compare('cantidad_disponible',$this->cantidad_disponible);

		$criteria->compare('precio_unitario',$this->precio_unitario,true);

		$criteria->compare('lote',$this->lote,true);

		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);

		return new CActiveDataProvider('Detalle_compra', array(
			'criteria'=>$criteria,
		));
	}
}