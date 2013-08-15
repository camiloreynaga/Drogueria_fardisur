<?php 
//----------conexion---------//
include("conexion.php");
$link = Conectarse();
//----------conexion---------//


//------parametros pasados por la URL-------------

$fechaInicio='2012-01-12';//valor recepcionado
$fechaFin='2012-12-12';//valor recepcionado
//--------------------------------------------


///-------consulta tabla clientes---------------------//
$consultaCliente="SELECT id, nombre, ruc, ciudad FROM cliente ORDER BY nombre ASC"; 
$cliente= mysql_query($consultaCliente,$link);

	$id=array();
	$nombre=array();
	$ruc=array();
	$ciudad=array();
	
while($row2=  mysql_fetch_array($cliente))
		{
		array_push($id,$row2[0]);
		array_push($nombre,$row2[1]);
		array_push($ruc,$row2[2]);
		array_push($ciudad,$row2[3]);
		}

?>
<?php
include('pdf/class.ezpdf.php'); //uso de la clase PDF
$pdf =& new Cezpdf('A4','landscape');// detalles de tipos de pagina y orientacion
$pdf->selectFont('pdf/fonts/courier.afm');
$datacreator = array ( //datos ocutos de creacion
					'Title'=>'COMPROBANTE DE PAGO',
					'Author'=>'FARMISUR',
					'Subject'=>'FARMISUR',
					'Creator'=>'RAYEDGARD@hotmail.com',
					'Producer'=>'SASDA'
					);
$pdf->addInfo($datacreator);


$cont=0;
for($j=0;$j<count($id);$j++)
{
///-------consulta tabla clientes---------------------//
$consultaVenta="SELECT id_empleado, fecha_venta, forma_envio, forma_pago, cantidad_cuotas, subtotal, impuesto, total, nro_factura FROM venta WHERE id_cliente='$id[$j]' AND  fecha_venta >= '$fechaInicio' AND fecha_venta <= '$fechaFin' ORDER BY fecha_venta DESC"; 
$venta= mysql_query($consultaVenta,$link);
	$id_empleado=array();
	$fecha_venta=array();
	$forma_envio=array();
	$forma_pago=array();
	$cantidad_cuotas=array();
	$subtotal=array();
	$impuesto=array();
	$total=array();
	$nro_factura=array();
	
while($row=  mysql_fetch_array($venta))
		{
		array_push($id_empleado,$row[0]);
		array_push($fecha_venta,$row[1]);
		array_push($forma_envio,$row[2]);
		array_push($forma_pago,$row[3]);
		array_push($cantidad_cuotas,$row[4]);
		array_push($subtotal,$row[5]);
		array_push($impuesto,$row[6]);
		array_push($total,$row[7]);
		array_push($nro_factura,$row[8]);
		}


for($i=0;$i<count($id_empleado);$i++)
{
$cont++;
$data[] = array('n'=>$cont,'ciudad'=>$ciudad[$j],'fecha'=>$fecha_venta[$i], 'cliente'=>$nombre[$j],'ruc'=>$ruc[$j],'envio'=>$forma_envio[$i],'pago'=>$forma_pago[$i],'cuotas'=>$cantidad_cuotas[$i],'subtotal'=>$subtotal[$i],'impuesto'=>$impuesto[$i],'total'=>$total[$i],'nfactura'=>$nro_factura[$i]);// areglo que almacena Datos 

}

}


$titles = array('n'=>'<b>Nro</b>','ciudad'=>'<b>Ciudad</b>','fecha'=>'<b>Fecha</b>','cliente'=>'<b>Cliente</b>','ruc'=>'<b>RUC</b>','envio'=>'<b>Forma Envio</b>','pago'=>'<b>Forma Pago</b>','cuotas'=>'<b>Nro Cuotas</b>', 'subtotal'=>'<b>SubTotal</b>','impuesto'=>'<b>Impuesto</b>','total'=>'<b>Total</b>','nfactura'=>'<b>Nro Factura</b>');// asignacion de titulos para cada dato o columna

//-----------------codigo que inserta la imagen o logo ------------------------------//
//$pdf->addJpegFromFile('imagenes/logo.jpg',20,320,150,'70');
$pdf->addJpegFromFile('imagenes/logo.jpg',600,470,180,'80');
//$pdf->setColor(0, 0, 255);
$pdf->ezText("<b>Reporte de Ventas por Ciudad</b>\n",25);
$pdf->ezText("Fecha de Reporte: ".date("Y/m/d"),12);
$pdf->ezText("<b>Periodo: del </b> ".$fechaInicio." Al ".$fechaFin,10);
//-----------------recuadro que muestra los detalles de venta de la factura------------------------------//
$pdf->ezText("\n\n",10);
$pdf->ezTable($data,$titles,'',array('showHeadings'=>1,'showLines'=>1,'shaded'=>1,'colGap' => 1,'fontSize' =>10,'lineCol' =>'0.3,0.8,0.1','xPos'=>'right','xOrientation'=>'left','width'=>750,'cols'=>array('proveedor'=>array('justification'=>'left','width'=>200))));



$pdf->ezStream();
?>
