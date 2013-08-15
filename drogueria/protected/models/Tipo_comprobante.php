<?php

/**
 * This is the model class for table "tipo_comprobante".
 *
 * The followings are the available columns in table 'tipo_comprobante':
 * @property integer $id_tipo_comprobante
 * @property string $comprobante
 */
class Tipo_comprobante extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tipo_comprobante the static model class
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
		return 'tipo_comprobante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id_tipo_comprobante', 'required'),
			array('id_tipo_comprobante', 'numerical', 'integerOnly'=>true),
			array('comprobante', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_tipo_comprobante, comprobante', 'safe', 'on'=>'search'),
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
			'comprobante_pagos' => array(self::HAS_MANY, 'ComprobantePago', 'tipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_comprobante' => 'Id Tipo Comprobante',
			'comprobante' => 'Comprobante',
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

		$criteria->compare('id_tipo_comprobante',$this->id_tipo_comprobante);

		$criteria->compare('comprobante',$this->comprobante,true);

		return new CActiveDataProvider('Tipo_comprobante', array(
			'criteria'=>$criteria,
		));
	}
}