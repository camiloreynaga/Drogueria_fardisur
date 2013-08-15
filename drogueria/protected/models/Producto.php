<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $id
 * @property integer $tipo_producto
 * @property string $nombre_producto
 * @property string $concentracion
 * @property integer $presentacion
 * @property integer $id_laboratorio
 * @property string $fecha_registro
 * @property string $fecha_baja
 * @property integer $minimo_stock
 * @property string $foto
 * @property integer $descontinuado
 * @property integer $precio
 * @property string $observaciones
 */
class Producto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Producto the static model class
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
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_producto, presentacion, id_laboratorio, minimo_stock, precio', 'required'),
			array('tipo_producto, presentacion, id_laboratorio, minimo_stock', 'numerical', 'integerOnly'=>true),
			array('nombre_producto, descontinuado', 'length', 'max'=>100),
                        array('precio','type','type'=>'float'),
			array('concentracion, fecha_registro, fecha_baja, foto, observaciones', 'safe'),
                    
                        array('fecha_registro', 'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
                        //array('fecha_registro', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipo_producto, nombre_producto, concentracion, presentacion, id_laboratorio, fecha_registro, fecha_baja, minimo_stock, foto, stock, observaciones', 'safe', 'on'=>'search'),
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
			'detalle_compras' => array(self::HAS_MANY, 'DetalleCompra', 'producto'),
			'detalle_ventas' => array(self::HAS_MANY, 'DetalleVenta', 'id_producto'),
			'laboratorio0' => array(self::BELONGS_TO, 'Laboratorio', 'id_laboratorio'),
			'presentacion0' => array(self::BELONGS_TO, 'Presentacion', 'presentacion'),
			'tipo_producto0' => array(self::BELONGS_TO, 'Tipo_producto', 'tipo_producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'tipo_producto' => 'Tipo Producto',
			'nombre_producto' => 'Nombre Producto',
			'concentracion' => 'Concentracion',
			'presentacion' => 'Presentacion',
			'laboratorio' => 'Laboratorio',
			'fecha_registro' => 'Fecha Registro',
			'fecha_baja' => 'Fecha Baja',
			'minimo_stock' => 'Minimo Stock',
			'foto' => 'Foto',
			'descontinuado' => 'Descontinuado',
			'observaciones' => 'Observaciones',
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
                
                $criteria->alias='producto';
                
		$criteria->compare('id',$this->id);

		$criteria->compare('tipo_producto',$this->tipo_producto);
		
		$criteria->with=array('tipo_producto0');

		$criteria->compare('nombre_producto',$this->nombre_producto,true);

		$criteria->compare('concentracion',$this->concentracion,true);

		$criteria->compare('presentacion',$this->presentacion);
		
		$criteria->with=array('presentacion0');

		$criteria->compare('id_laboratorio',$this->id_laboratorio);
		//$criteria->compare('laboratorio',Yii::app()->Laboratorio->laboratorio);
		
		$criteria->with=array('laboratorio0');

		$criteria->compare('fecha_registro',$this->fecha_registro,true);

		$criteria->compare('fecha_baja',$this->fecha_baja,true);

		$criteria->compare('minimo_stock',$this->minimo_stock);

		$criteria->compare('foto',$this->foto,true);
                
                //$criteria->compare('stock',$this->stock,true);

		$criteria->compare('descontinuado',$this->descontinuado);

		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider('Producto', array(
			'criteria'=>$criteria,
		));
	}
	
	//Llenado de Combos
	public function getListTipos_produtos()
	{
		$criteria = new CDbCriteria();
		$criteria->order='tipo_producto';
		return Tipo_producto::model()->findAll($criteria);
		
	}
	
	public function getListPresentacion()
	{
		$criteria = new CDbCriteria();
		$criteria->order='presentacion';
		return Presentacion::model()->findAll($criteria);
		
	}
	
	public function getListLaboratorio()
	{
		$criteria = new CDbCriteria();
		$criteria->order='laboratorio';
		return Laboratorio::model()->findAll($criteria);
		
	}
        
        public function checkStock()
        {
            $productos=Producto::model()->findAll();
            $alert=array();
            foreach($productos as $producto)
            {
                if($producto->stock<=$producto->minimo_stock)
                {
                    $alert[]=array(
                        'id'=>$producto->id,
                        'name'=>$producto->nombre_producto,
                        'stock'=>$producto->stock
                    );
                }
            }
            return $alert;
        }
}