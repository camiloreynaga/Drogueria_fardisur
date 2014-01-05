<?php

/**
 * This is the model class for table "empleado".
 *
 * The followings are the available columns in table 'empleado':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $direccion
 * @property string $telefono
 * @property string $movil
 * @property string $dni
 * @property string $fecha_nacimiento
 */
class Empleado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Empleado the static model class
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
		return 'empleado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('nombre,apellido_paterno','required'),
			array('nombre, apellido_paterno, apellido_materno', 'length', 'max'=>50),
			array('direccion', 'length', 'max'=>100),
			array('telefono', 'length', 'max'=>20),
			array('movil, dni', 'length', 'max'=>15),
			array('fecha_nacimiento', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, apellido_paterno, apellido_materno, direccion, telefono, movil, dni, fecha_nacimiento', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'empleado'),
			'ventas' => array(self::HAS_MANY, 'Venta', 'id_empleado'),
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
			'apellido_paterno' => 'Apellido Paterno',
			'apellido_materno' => 'Apellido Materno',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'movil' => 'Movil',
			'dni' => 'Dni',
			'fecha_nacimiento' => 'Fecha Nacimiento',
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

		$criteria->compare('apellido_paterno',$this->apellido_paterno,true);

		$criteria->compare('apellido_materno',$this->apellido_materno,true);

		$criteria->compare('direccion',$this->direccion,true);

		$criteria->compare('telefono',$this->telefono,true);

		$criteria->compare('movil',$this->movil,true);

		$criteria->compare('dni',$this->dni,true);

		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);

		return new CActiveDataProvider('Empleado', array(
			'criteria'=>$criteria,
		));
	}
	
	public function getListLaboratorio()
	{
		$criteria = new CDbCriteria();
		$criteria->order='laboratorio';
		return Laboratorio::model()->findAll($criteria);
		
	}
}