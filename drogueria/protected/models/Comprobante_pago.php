<?php

/**
 * This is the model class for table "comprobante_pago".
 *
 * The followings are the available columns in table 'comprobante_pago':
 * @property integer $idcomprobante_pago
 * @property integer $venta
 * @property integer $tipo
 * @property string $serie
 * @property string $numero
 * @property integer $estado
 */
class Comprobante_pago extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comprobante_pago the static model class
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
		return 'comprobante_pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('venta, tipo, estado', 'required'),
			array('venta, tipo, estado', 'numerical', 'integerOnly'=>true),
			array('serie, numero', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcomprobante_pago, venta, tipo, serie, numero, estado', 'safe', 'on'=>'search'),
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
			'tipo0' => array(self::BELONGS_TO, 'TipoComprobante', 'tipo'),
			'venta0' => array(self::BELONGS_TO, 'Venta', 'venta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcomprobante_pago' => 'Idcomprobante Pago',
			'venta' => 'Venta',
			'tipo' => 'Tipo',
			'serie' => 'Serie',
			'numero' => 'Numero',
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

		$criteria->compare('idcomprobante_pago',$this->idcomprobante_pago);

		$criteria->compare('venta',$this->venta);

		$criteria->compare('tipo',$this->tipo);

		$criteria->compare('serie',$this->serie,true);

		$criteria->compare('numero',$this->numero,true);

		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider('Comprobante_pago', array(
			'criteria'=>$criteria,
		));
	}
}