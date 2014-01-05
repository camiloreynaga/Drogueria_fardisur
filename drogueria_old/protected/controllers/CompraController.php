<?php

class CompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addItem','DeleteItem','DeleteCuota','FinalizarCompra','AgregarDetalle','confirmarCompra','PagarCuenta'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','AgregarDetalle','confirmarCompra'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $model->fecha_compra=date('Y-m-d');
		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
                        $model->estado='1';
			if($model->save())
				$this->redirect(array('AgregarDetalle','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model=$this->loadModel();
                        $model->deleteDetaills();
                        $model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Compra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Compra']))
			$model->attributes=$_GET['Compra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionAgregarDetalle($id)
	{
		$compra=Compra::model()->findByPk($id);
		$this->render('detaillBuy',array(
			'compra'=>$compra
			));
	}
	public function actionAgregarItem($id)
	{
		$model=new Detalle_compra;
		if(isset($_POST['Detalle_compra']))
                {
                    $model->attributes=$_POST['Detalle_compra'];
                    if($model->save())
                    {
                        if (Yii::app()->request->isAjaxRequest)
                        {
                            echo CJSON::encode(array(
                                'status'=>'success', 
                                'div'=>"Item agregado exitosamente."
                                ));
                            exit;            
                        }
                        else
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }

                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'failure', 
                        'div'=>$this->renderPartial('_addItem', array('model'=>$model), true)));
                    exit;               
                }
                else
                    $this->render('create',array('model'=>$model,));
    
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Compra::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAddItem($idItem,$idCompra)
        {
            $compraItem=new Detalle_compra;
            $compraItem->id_compra=$idCompra;
            $compraItem->producto=$idItem;
            //$compraIten->lote=$
            $compraItem->setScenario('create');
            
           // $tmp=Detalle_compra::model()->count('id_compra=:id_compra and producto=:producto',array(':id_compra'=>$idCompra,':producto'=>$idItem));
//            if($tmp==0)
//            {
                $producto= Producto::model()->findByPk($idItem);

                if(isset($_POST['Detalle_compra']))
                {
                    $compraItem->attributes=$_POST['Detalle_compra'];
                    $compraItem->subtotal=$compraItem->precio_unitario*$compraItem->cantidad;
                    $compraItem->cantidad_disponible=$compraItem->cantidad;//agregando la cantidad disponible
                    $compraItem->impuesto=$compraItem->subtotal*((int)Yii::app()->params['impuesto']*0.01);
                    $compraItem->total=$compraItem->subtotal+$compraItem->impuesto;
                    if($compraItem->save())
                    {
                        if (Yii::app()->request->isAjaxRequest)
                        {
                            echo CJSON::encode(array(
                                'status'=>'success', 
                                'div'=>"Producto agregado correctamente."
                                ));
                            exit;
                        }
                        else
                            $this->redirect(array('view','id'=>$model->id));
                    }
                }

                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'failure', 
                        'div'=>$this->renderPartial('//detalle_compra/_form', array('model'=>$compraItem), true,true)));
                    exit;               
                }
                else
                    $this->render('create',array('model'=>$model,));
//            }
//            else
//            {
//                echo CJSON::encode(array(
//                    'status'=>'exist', 
//                    'div'=>"El producto ya está seleccionado."
//                    ));
//                exit;
//            }
            
        }
        public function actionDeleteItem($id)
        {
            Detalle_compra::model()->deleteByPk($id);
        }
        
        public function actionconfirmarCompra($id,$updateStock=false)
        {
            $model=Compra::model()->findByPk($id);
            $model->estado=3;
            $model->save();
            $cuota=new Cuenta_pagar;
            if($updateStock)
                $model->updateStock();
            
            if(isset($_POST['Cuenta_pagar']))
            {
                $_cuota=new Cuenta_pagar;
                $_cuota->attributes=$_POST['Cuenta_pagar'];
                $_cuota->compra=$id;
                $_cuota->estado=0;
                if($model->TotalCuotas+$_cuota->monto<=$model->total)
                {
                    $_cuota->save();
                    $_cuota->monto=$model->total-$_cuota->monto;
                }
                else
                    $_cuota->addError('monto','El monto supera el total calculado.');
                
                    $this->render('cuotas',
                        array(
                                'compra'=>$model,
                                'model'=>$_cuota
                            )
                        );
                    exit;
            }
            
            $this->render('cuotas',
                    array(
                            'compra'=>$model,
                            'model'=>$cuota
                        )
                    );
            
        }
        public function actionDeleteCuota($id)
        {
            Cuenta_pagar::model()->deleteByPk($id);
        }
        public function actionFinalizarCompra($id)
        {
            $this->redirect(array('compra/view','id'=>$id));
        }
        public function actionPagarCuenta($id,$idCompra)
        {
            $model=Cuenta_pagar::model()->findByPk($id);
            $model->estado=1;
            $model->fecha_pago= date('y/m/d');
            $model->save();
            $this->redirect(array('compra/view','id'=>$idCompra));
        }
}
