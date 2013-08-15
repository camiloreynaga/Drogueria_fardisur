<?php

/**
 * This is the model class for table "cuenta_cobrar".
 *
 * The followings are the available columns in table 'cuenta_cobrar':
 * @property integer $idcuenta_cobrar
 * @property integer $venta
 * @property string $monto
 * @property string $fecha_pago
 * @property integer $estado
 */
class Cuenta_cobrar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cuenta_cobrar the static model class
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
		return 'cuenta_cobrar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('venta, estado,fecha_vencimiento', 'required'),
			array('venta, estado', 'numerical', 'integerOnly'=>true),
			array('monto', 'length', 'max'=>10),
			array('fecha_pago', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuenta_cobrar, venta, monto, fecha_pago, estado', 'safe', 'on'=>'search'),
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
			'venta0' => array(self::BELONGS_TO, 'Venta', 'venta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcuenta_cobrar' => 'Idcuenta Cobrar',
			'venta' => 'Venta',
			'monto' => 'Monto',
			'fecha_pago' => 'Fecha Pago',
			'estado' => 'Estado',
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

		$criteria->compare('idcuenta_cobrar',$this->idcuenta_cobrar);

		$criteria->compare('venta',$this->venta);

		$criteria->compare('monto',$this->monto,true);

		$criteria->compare('fecha_pago',$this->fecha_pago,true);

		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider('Cuenta_cobrar', array(
			'criteria'=>$criteria,
		));
	}
}