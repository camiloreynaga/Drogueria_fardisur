<?php

/**
 * This is the model class for table "proveedor".
 *
 * The followings are the available columns in table 'proveedor':
 * @property integer $id
 * @property string $nombre_proveedor
 * @property string $ruc
 * @property string $contacto
 * @property string $direccion
 * @property string $ciudad
 * @property string $fecha
 * @property string $telefono
 */
class Proveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Proveedor the static model class
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
		return 'proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id', 'numerical', 'integerOnly'=>true),
                        array('nombre_proveedor,ruc,contacto,direccion, ciudad', 'required'),
			array('nombre_proveedor, ciudad, telefono', 'length', 'max'=>50),
			array('ruc', 'length', 'max'=>11),
                        array('ruc', 'length', 'min'=>11),
			array('contacto, direccion', 'length', 'max'=>100),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre_proveedor, ruc, contacto, direccion, ciudad, fecha, telefono', 'safe', 'on'=>'search'),
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
			'compras' => array(self::HAS_MANY, 'Compra', 'id_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'nombre_proveedor' => 'Nombre Proveedor',
			'ruc' => 'Ruc',
			'contacto' => 'Contacto',
			'direccion' => 'Direccion',
			'ciudad' => 'Ciudad',
			'fecha' => 'Fecha',
			'telefono' => 'Telefono',
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

		$criteria->compare('nombre_proveedor',$this->nombre_proveedor,true);

		$criteria->compare('ruc',$this->ruc,true);

		$criteria->compare('contacto',$this->contacto,true);

		$criteria->compare('direccion',$this->direccion,true);

		$criteria->compare('ciudad',$this->ciudad,true);

		$criteria->compare('fecha',$this->fecha,true);

		$criteria->compare('telefono',$this->telefono,true);

		return new CActiveDataProvider('Proveedor', array(
			'criteria'=>$criteria,
		));
	}
}