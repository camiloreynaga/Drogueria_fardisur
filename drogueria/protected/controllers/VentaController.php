<?php

class VentaController extends Controller
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
				'actions'=>array('create','update','AgregarDetalle','AgregarItem','addItem','DeleteItem','DeleteCuota','confirmarventa','BuildPdf','finalizarventa','pagarCuenta','TotalByLote'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','AgregarDetalle','confirmarVenta'),
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
	public function actionView($id,$print=false)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Venta;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Venta']))
		{
			$model->attributes=$_POST['Venta'];
                        $model->fecha_venta=date('Y-m-d');
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

		if(isset($_POST['Venta']))
		{
			$model->attributes=$_POST['Venta'];
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
			//$this->loadModel()->delete();
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
		$dataProvider=new CActiveDataProvider('Venta');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Venta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Venta']))
			$model->attributes=$_GET['Venta'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
				$this->_model=Venta::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='venta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAgregarDetalle($id)
        {
            $venta=Venta::model()->findByPk($id);
            $this->render('_detailSale',array(
                    'venta'=>$venta
                    ));
        }
        
        public function actionAgregarItem($id)
	{
		$model=new Detalle_venta;
		if(isset($_POST['Detalle_venta']))
                {
                    $model->attributes=$_POST['Detalle_venta'];
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
        
        public function actionAddItem($idItem,$idventa)
        {
            $venta=Venta::model()->findByPk($idventa);
            $producto=Producto::model()->findByPk($idItem);
            $ventaItem=new Detalle_venta;
            $ventaItem->id_venta=$idventa;
            $ventaItem->id_producto=$idItem;
            $ventaItem->setScenario('create');
            
            //$tmp=Detalle_venta::model()->count('id_venta=:id_venta and id_producto=:producto',array(':id_venta'=>$idventa,':producto'=>$idItem));
//            if($tmp==0)
//            {
                $producto= Producto::model()->findByPk($idItem);

                if(isset($_POST['Detalle_venta']))
                {
                    $ventaItem->attributes=$_POST['Detalle_venta'];
                    
                    //calculando la cantidad disponible, aún así se tenga uno o más tuplas como resultado de la consulta
                    //$tmp=Detalle_compra::model()->findall('lote=:lote',array(':lote'=>$id));
                    //$tmp=Detalle_compra::model()->findAll('producto=:id_producto and lote=:lote',array(':id_producto'=>$idItem,':lote'=>$ventaItem->lote));

                    $tmp=Detalle_compra::model()->find('producto=:id_producto and lote=:lote',array(':id_producto'=>$idItem,':lote'=>$ventaItem->lote));
                    
                    
                    
                    if($this->cantidad_lote2($idItem,$ventaItem->lote) >=(int) $ventaItem->cantidad)//if($tmp->cantidad_disponible>=(int) $ventaItem->cantidad)
                    {
                        $ventaItem->total=$ventaItem->precio_unitario*$ventaItem->cantidad;
                        $ventaItem->subtotal= round(($ventaItem->total/1.18)*100)/100; 
                        $ventaItem->impuesto= round(($ventaItem->total/1.18)*0.18*100)/100; 
                        $ventaItem->fecha_vencimiento= $tmp->fecha_vencimiento;
                        if($ventaItem->save())
                        {
                            if (Yii::app()->request->isAjaxRequest)
                            {
                                $venta->updateTotal();
                                $venta->updateCantidad($idItem,$ventaItem->cantidad,$ventaItem->lote);
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
                    else
                        $ventaItem->addError('cantidad','La cantidad seleccionada excede el total disponible.');
                }

                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'failure', 
                        'div'=>$this->renderPartial('//detalle_venta/_form', array('model'=>$ventaItem), true,true)));
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
        public function actionDeleteItem($id,$idVenta)
        {
//            $idVenta;
//            $idProducto;
//            $cantidad;
//            $lote;
            
            $ventaItem=Detalle_venta::model()->findByPk($id);
                     
            
            $venta=Venta::model()->findByPk($idVenta);
            $venta->restoreCantidad($ventaItem->id_producto,$ventaItem->cantidad,$ventaItem->lote);
            Detalle_venta::model()->deleteByPk($id);
            //
        }
        
        public function actionconfirmarVenta($id,$updateStock=false)
        {
            $model=Venta::model()->findByPk($id);
            $model->estado=3;
            $model->save();
            $cuota=new Cuenta_cobrar;
            if($updateStock)
                $model->updateStock();
            
            if(isset($_POST['Cuenta_cobrar']))
            {
                $_cuota=new Cuenta_cobrar;
                $_cuota->attributes=$_POST['Cuenta_cobrar'];
                $_cuota->venta=$id;
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
                            'venta'=>$model,
                            'model'=>$_cuota
                        )
                    );
                exit;
            }
            $this->render('cuotas',
                    array(
                            'venta'=>$model,
                            'model'=>$cuota
                        )
                    );
            
        }
        public function actionDeleteCuota($id)
        {
            Cuenta_cobrar::model()->deleteByPk($id);
        }
        public function actionBuildPdf($id)
        {
            $venta=Venta::model()->findByPk($id);
            //$tmp=$this->renderPartial('pdf_layout',array('data'=>$document),true);
            $texto=$this->numeroTexto($venta->Total);
            $tmp=$this->renderPartial('pdf_layout',array(
                'data'=>$venta,
                'texto'=>$texto
                ),true);
            $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'mm', 'Letter', true, 'UTF-8', false);
            $pdf = new MYPDF('L', 'mm', 'B5', true, 'UTF-8', false);
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->SetMargins(0, 0, PDF_MARGIN_RIGHT);
            

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->SetCreator('farma');
            $pdf->SetAuthor("farma");
            $pdf->SetTitle("factura");
            $pdf->SetSubject("TCPDF Tutorial");
            $pdf->SetKeywords("TCPDF, PDF, example, test, guide");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont("arial", "N", 10);
            
            $pdf->writeHTML($tmp);
            $pdf->Output('factura.pdf', "I");
        }
        
        function numeroTexto($numero)
        { 
        // Primero tomamos el numero y le quitamos los caracteres especiales y extras 
        // Dejando solamente el punto "." que separa los decimales 
        // Si encuentra mas de un punto, devuelve error. 
        // NOTA: Para los paises en que el punto y la coma se usan de forma 
        // inversa, solo hay que cambiar la coma por punto en el array de "extras" 
        // y el punto por coma en el explode de $partes 

        $extras= array("/[\$]/","/ /","/,/","/-/"); 
        $limpio=preg_replace($extras,"",$numero); 
        $partes=explode(".",$limpio); 
        if (count($partes)>2)
        { 
            return "Error, el n&uacute;mero no es correcto"; 
            exit(); 
        } 

        // Ahora explotamos la parte del numero en elementos de un array que 
        // llamaremos $digitos, y contamos los grupos de tres digitos 
        // resultantes 

        $digitos_piezas=chunk_split ($partes[0],1,"#"); 
        $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1); 
        $digitos=explode("#",$digitos_piezas); 
        $todos=count($digitos); 
        $grupos=ceil (count($digitos)/3); 


        // comenzamos a dar formato a cada grupo 

        $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete'  ,'ocho','nueve'); 
        $decenas = array ('diez','once','doce', 'trece','catorce','quince'); 
        $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta'  ,'sesenta','setenta','ochenta','noventa'); 
        $centena = array   ('ciento','doscientos','trescientos','cuatrociento  s','quinientos','seiscientos','setecientos','ochoc  ientos','novecientos'); 
        $resto=$todos; 

        for ($i=1; $i<=$grupos; $i++) { 

            // Hacemos el grupo 
            if ($resto>=3) 
                $corte=3;  
            else  
                $corte=$resto; 
            
                $offset=(($i*3)-3)+$corte; 
                $offset=$offset*(-1); 

            // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB 



            $num=implode("",array_slice ($digitos,$offset,$corte)); 
            $resultado[$i] = ""; 
            $cen = (int) ($num / 100);              //Cifra de las centenas 
            $doble = $num - ($cen*100);             //Cifras de las decenas y unidades 
            $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas 
            $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades 
            if ($cen > 0) { 
               if ($num == 100) $resultado[$i] = "cien"; 
               else $resultado[$i] = $centena[$cen-1].' '; 
            }//end if 
            if ($doble>0) { 
               if ($doble == 20) { 
                  $resultado[$i] .= " veinte"; 
               }elseif (($doble < 16) and ($doble>9)) { 
                  $resultado[$i] .= $decenas[$doble-10]; 
               }else { 
                  if(isset($decena[$dec-1]))
                      $resultado[$i] .=' '. $decena[$dec-1]; 
               }//end if 
               if ($dec>2 and $uni<>0) $resultado[$i] .=' y '; 
               if (($uni>0) and ($doble>15) or ($dec==0)) { 
                  if ($i==1 && $uni == 1) $resultado[$i].="uno"; 
                  elseif ($i==2 && $num == 1) $resultado[$i].=""; 
                  else $resultado[$i].=$unidad[$uni-1]; 
               } 
            } 

            // Le agregamos la terminacion del grupo 
            switch ($i) { 
                case 2: 
                $resultado[$i].= ($resultado[$i]=="") ? "" : " mil "; 
                break; 
                case 3: 
                $resultado[$i].= ($num==1) ? " mill&oacute;n " : " millones "; 
                break; 
            } 
            $resto-=$corte; 
        } 

        // Sacamos el resultado (primero invertimos el array) 
        $resultado_inv= array_reverse($resultado, TRUE); 
        $final=""; 
        foreach ($resultado_inv as $parte){ 
            $final.=$parte; 
        } 
        if(isset($partes[1]))
            return $final." con ".$partes[1]."/100 nuevos soles"; 
        else
            return $final." con ".$partes[0]."/100 nuevos soles"; 
    }
    
    public function actionfinalizarVenta($id)
    {
        $tmp=Venta::model()->findByPk($id);
        $tmp->estado=4;
        $tmp->save();
        $this->redirect(array('venta/view','id'=>$id,'print'=>true));
    }
    
    public function actionpagarCuenta($id,$idventa)
    {
        $model=Cuenta_cobrar::model()->findByPk($id);
        $model->estado=1;
        $model->fecha_pago= date('y/m/d');
        $model->save();
        $this->redirect(array('venta/view','id'=>$idventa));
    }
    //muestra la cantidad disponible por lote
    public function actionTotalByLote($id,$producto)
    {
        //recuperar la cantidad tuplas con el mismo lote
        // sumar la "cantidad_disponible" si la catidad de tuplas es mayor 1
        $rows=  Detalle_compra::model()->count('lote=:lote',array(':lote'=>$id));

        echo CHtml::encode('Cantidad disponible '. $this->cantidad_lote2($producto,$id) .' (Unds)'); 
    
    }
    
    function cantidad_lote($lote)
    {
        $cantidad_lote=0;
        $tmp= Detalle_compra::model()->findall('lote=:lote',array(':lote'=>$lote));
        foreach($tmp as $r)
        {
            $cantidad_lote+=$r->cantidad_disponible;
        }
        return $cantidad_lote;
    }
    function cantidad_lote2($producto,$lote)
    {
        $cantidad_lote=0;
        $tmp= Detalle_compra::model()->findall('producto=:id_producto and lote=:lote',array(':id_producto'=>$producto,':lote'=>$lote));
        foreach($tmp as $r)
        {
            $cantidad_lote+=$r->cantidad_disponible;
        }
        return $cantidad_lote;
    }
    
}
