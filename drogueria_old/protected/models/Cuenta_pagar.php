<?php

/**
 * This is the model class for table "cuenta_pagar".
 *
 * The followings are the available columns in table 'cuenta_pagar':
 * @property integer $idcuenta_pagar
 * @property integer $compra
 * @property string $monto
 * @property integer $estado
 * @property string $fecha_pago
 * @property string $interes
 */
class Cuenta_pagar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cuenta_pagar the static model class
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
		return 'cuenta_pagar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('compra, monto, fecha_vencimiento', 'required'),
			array('compra, estado', 'numerical', 'integerOnly'=>true),
			array('monto', 'length', 'max'=>10),
			array('interes', 'length', 'max'=>2),
			array('fecha_pago', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuenta_pagar, compra, monto, estado,fecha_vencimiento, fecha_pago, interes', 'safe', 'on'=>'search'),
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
			'compra0' => array(self::BELONGS_TO, 'Compra', 'compra'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcuenta_pagar' => 'Idcuenta Pagar',
			'compra' => 'Compra',
			'monto' => 'Monto',
			'estado' => 'Estado',
                        'fecha_vencimiento' => 'Fecha Vencimiento',
			'fecha_pago' => 'Fecha Pago',
			'interes' => 'Interes',
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

		$criteria->compare('idcuenta_pagar',$this->idcuenta_pagar);

		$criteria->compare('compra',$this->compra);

		$criteria->compare('monto',$this->monto,true);

		$criteria->compare('estado',$this->estado);

		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
                
                $criteria->compare('fecha_pago',$this->fecha_pago,true);

		$criteria->compare('interes',$this->interes,true);

		return new CActiveDataProvider('Cuenta_pagar', array(
			'criteria'=>$criteria,
		));
	}
        
        public function getCurrentEstado()
        {
            $estados=array(
                    0=>'Pendiente',
                    1=>'Pagado'
                );
            if(empty($this->estado))
                return $estados;
            else
                echo $estados[(int)$this->estado];
        }
}