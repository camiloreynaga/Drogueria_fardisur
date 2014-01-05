<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainMbmenu">
		<?php  $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
                                array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Usuarios',
                                    'items'=>array( 
                                        array('label'=>'Crear','url'=>array('/usuario/create')), 
                                        array('label'=>'Administrar','url'=>array('/usuario/index')), 
                                      ), 
                                ),
                                array('label'=>'Productos',
                                    'items'=>array( 
                                        array('label'=>'Crear','url'=>array('/producto/create')), 
                                        array('label'=>'Administrar','url'=>array('/producto/index')), 
                                      ), 
                                ),
                                array('label'=>'Compras', 'items'=>array( 
                                        array('label'=>'Crear','url'=>array('/compra/create')), 
                                        array('label'=>'Administrar','url'=>array('/compra/index')), 
                                      )),
                                array('label'=>'Ventas', 'items'=>array( 
                                        array('label'=>'Crear','url'=>array('/venta/create')), 
                                        array('label'=>'Administrar','url'=>array('/venta/index')), 
                                      )),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Proveedores', 'url'=>array('/proveedor')),
				array('label'=>'Clientes', 'url'=>array('/cliente')),
                            
                            
                                array('label'=>'Reportes', 'items'=>array( 
                                        array('label'=>'Clientes','url'=>array("site/RepClientes"),'linkOptions'=>array('target'=>'_BLANK')),  // revisar link a ulilizar
                                        array('label'=>'Compras','url'=>array("site/RepCompras"),'linkOptions'=>array('target'=>'_BLANK')), 
                                        array('label'=>'Cuentas por cobrar','url'=>array("site/RepCuentasCobrar"),'linkOptions'=>array('target'=>'_BLANK')), 
                                        array('label'=>'Cuentas por pagar','url'=>array("site/RepCuentasPagar"),'linkOptions'=>array('target'=>'_BLANK')), 
                                        array('label'=>'stock','url'=>array("site/RepStock"),'linkOptions'=>array('target'=>'_BLANK')), 
                                        array('label'=>'Ventas por ciudad','url'=>array("site/RepVentasCiudad"),'linkOptions'=>array('target'=>'_BLANK')), 
                                        array('label'=>'Ventas por laboratorio','url'=>array("site/RepVentasLaboratorio"),'linkOptions'=>array('target'=>'_BLANK')), 
                                    ),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		));
		
		 ?> 
	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php  endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>