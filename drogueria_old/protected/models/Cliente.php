<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $id
 * @property string $nombre
 * @property string $ruc
 * @property string $direccion
 * @property string $ciudad
 * @property string $fecha_registro
 * @property string $telefono
 * @property string $email
 * @property string $contacto
 * @property string $telefono_contacto
 */
class Cliente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cliente the static model class
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
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('nombre,ruc, direccion, ciudad, contacto','required'),
			array('nombre, direccion, ciudad, email, contacto', 'length', 'max'=>100),
			array('ruc', 'length', 'max'=>11),
                        array('ruc', 'length', 'min'=>11),
			array('telefono, telefono_contacto', 'length', 'max'=>15),
			array('fecha_registro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, ruc, direccion, ciudad, fecha_registro, telefono, email, contacto, telefono_contacto', 'safe', 'on'=>'search'),
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
			'ventas' => array(self::HAS_MANY, 'Venta', 'id_cliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'nombre' => 'Nombre',
			'ruc' => 'Ruc',
			'direccion' => 'Direccion',
			'ciudad' => 'Ciudad',
			'fecha_registro' => 'Fecha Registro',
			'telefono' => 'Telefono',
			'email' => 'Email',
			'contacto' => 'Contacto',
			'telefono_contacto' => 'Telefono Contacto',
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

		$criteria->compare('nombre',$this->nombre,true);

		$criteria->compare('ruc',$this->ruc,true);

		$criteria->compare('direccion',$this->direccion,true);

		$criteria->compare('ciudad',$this->ciudad,true);

		$criteria->compare('fecha_registro',$this->fecha_registro,true);

		$criteria->compare('telefono',$this->telefono,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('contacto',$this->contacto,true);

		$criteria->compare('telefono_contacto',$this->telefono_contacto,true);

		return new CActiveDataProvider('Cliente', array(
			'criteria'=>$criteria,
		));
	}
}