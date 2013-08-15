<?php 
//----------conexion---------//
include("conexion.php");
$link = Conectarse();
//----------conexion---------//


//------parametros pasados por la URL-------------

$fechaInicio='2010-01-12';//valor recepcionado
$fechaFin='2012-12-12';//valor recepcionado
//--------------------------------------------


///-------consulta tabla compras---------------------//
$consultaCompras ="SELECT fecha_compra, id_proveedor, nro_factura, almacen, subtotal, impuesto, total FROM compra WHERE fecha_compra >= '$fechaInicio' AND fecha_compra <= '$fechaFin' ORDER BY fecha_compra DESC"; 
//$consultaCompras ="SELECT fecha_compra, id_proveedor, nro_factura, almacen, subtotal, impuesto, total FROM compra ORDER BY fecha_compra DESC"; 
$compra= mysql_query($consultaCompras,$link);

	$fecha_compra=array();
	$id_proveedor=array();
	$nro_factura=array();
	$almacen=array();
	$subtotal=array();
	$impuesto=array();
	$total=array();

while($row2=  mysql_fetch_array($compra))
		{
		array_push($fecha_compra,$row2[0]);
		array_push($id_proveedor,$row2[1]);
		array_push($nro_factura,$row2[2]);
		array_push($almacen,$row2[3]);
		array_push($subtotal,$row2[4]);
		array_push($impuesto,$row2[5]);
		array_push($total,$row2[6]);
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

for($j=0;$j<count($fecha_compra);$j++)
{
//------consulta para obtener el proveedor---------------//
$consultaProveedor= mysql_query("SELECT nombre_proveedor, ruc FROM proveedor WHERE id='$id_proveedor[$j]'",$link);
$proveedor=  mysql_fetch_array($consultaProveedor);
//-------------------fin -----------------------//
//-----Consulta para obtener el Almacen-------------//
$consultaAlmacen= mysql_query("SELECT almacen FROM almacen WHERE id_almacen='$almacen[$j]'",$link);
$Almacen=  mysql_fetch_array($consultaAlmacen);
//--------------------------------------------------------------

$data[] = array('n'=>$j+1,'fecha'=>$fecha_compra[$j], 'proveedor'=>$proveedor[0],'ruc'=>$proveedor[1],'nfactura'=>$nro_factura[$j],'almacen'=>$Almacen[0],'subtotal'=>$subtotal[$j],'impuesto'=>$impuesto[$j],'total'=>$total[$j]);// areglo que almacena Datos 


}


$titles = array('n'=>'<b>Nro</b>','fecha'=>'<b>Fecha</b>','proveedor'=>'<b>Proveedor</b>','ruc'=>'<b>RUC</b>','nfactura'=>'<b>N° Factura</b>','almacen'=>'<b>Almacen</b>','subtotal'=>'<b>SubTotal</b>','impuesto'=>'<b>Impuesto</b>', 'total'=>'<b>Total</b>');// asignacion de titulos para cada dato o columna

//-----------------codigo que inserta la imagen o logo ------------------------------//
//$pdf->addJpegFromFile('imagenes/logo.jpg',20,320,150,'70');
$pdf->addJpegFromFile('imagenes/logo.jpg',600,470,180,'80');
//$pdf->setColor(0, 0, 255);
$pdf->ezText("<b>Reporte de Compras por periodo</b>\n",25);
$pdf->ezText("Fecha de Reporte: ".date("Y/m/d"),12);
$pdf->ezText("<b>Periodo: del </b> ".$fechaInicio." Al ".$fechaFin,10);
//-----------------recuadro que muestra los detalles de venta de la factura------------------------------//
$pdf->ezText("\n\n",10);
$pdf->ezTable($data,$titles,'',array('showHeadings'=>1,'showLines'=>1,'shaded'=>1,'colGap' => 1,'fontSize' =>10,'lineCol' =>'0.3,0.8,0.1','xPos'=>'right','xOrientation'=>'left','width'=>750,'cols'=>array('proveedor'=>array('justification'=>'left','width'=>200))));



$pdf->ezStream();
?>
