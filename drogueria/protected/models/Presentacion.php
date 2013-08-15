<?php

/**
 * This is the model class for table "presentacion".
 *
 * The followings are the available columns in table 'presentacion':
 * @property integer $id_presentacion
 * @property string $presentacion
 * @property string $nomeclatura
 */
class Presentacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Presentacion the static model class
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
		return 'presentacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('presentacion,nomeclatura','required'),
			array('presentacion', 'length', 'max'=>50),
			array('nomeclatura', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_presentacion, presentacion, nomeclatura', 'safe', 'on'=>'search'),
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
			'productos' => array(self::HAS_MANY, 'Producto', 'presentacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_presentacion' => 'Id Presentacion',
			'presentacion' => 'Presentacion',
			'nomeclatura' => 'Nomeclatura',
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

		$criteria->compare('id_presentacion',$this->id_presentacion);

		$criteria->compare('presentacion',$this->presentacion,true);

		$criteria->compare('nomeclatura',$this->nomeclatura,true);

		return new CActiveDataProvider('Presentacion', array(
			'criteria'=>$criteria,
		));
	}
}