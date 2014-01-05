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
$consultaDetalle="SELECT l.laboratorio,v.fecha_venta,p.nombre_producto, d.lote, d.precio_unitario, p.presentacion, p.stock FROM  venta v INNER JOIN(detalle_venta d
INNER JOIN (producto p INNER JOIN laboratorio l ON p.laboratorio=l.id) 
    ON d.id_producto=p.id)ON v.id=d.id_venta WHERE v.fecha_venta >='$fechaInicio' AND v.fecha_venta<='$fechaFin'"; 
$detalle= mysql_query($consultaDetalle,$link);

	$laboratorio=array();
	$fecha=array();
	$producto=array();
	$lote=array();
	$precio=array();
	$presentacion=array();
	$stock=array();
	
	
while($row2=  mysql_fetch_array($detalle))
		{
		array_push($laboratorio,$row2[0]);
		array_push($fecha,$row2[1]);
		array_push($producto,$row2[2]);
		array_push($lote,$row2[3]);
		array_push($precio,$row2[4]);
		array_push($presentacion,$row2[5]);
		array_push($stock,$row2[6]);
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
for($j=0;$j<count($laboratorio);$j++)
{

$cont++;
$data[] = array('n'=>$cont,'laboratorio'=>$laboratorio[$j],'fecha'=>$fecha[$j], 'producto'=>$producto[$j],'lote'=>$lote[$j],'precio'=>$precio[$j],'presentacion'=>$presentacion[$j],'stock'=>$stock[$j]);// areglo que almacena Datos 


}


$titles = array('n'=>'<b>Nro</b>','laboratorio'=>'<b>Laboratorio</b>','fecha'=>'<b>Fecha</b>','producto'=>'<b>Productos</b>','lote'=>'<b>Lote</b>','precio'=>'<b>Precio</b>','presentacion'=>'<b>Presentacion</b>','stock'=>'<b>Stock</b>');// asignacion de titulos para cada dato o columna

//-----------------codigo que inserta la imagen o logo ------------------------------//
//$pdf->addJpegFromFile('imagenes/logo.jpg',20,320,150,'70');
$pdf->addJpegFromFile('imagenes/logo.jpg',600,470,180,'80');
//$pdf->setColor(0, 0, 255);
$pdf->ezText("<b>Reporte de Ventas por Laboratorio</b>\n",25);
$pdf->ezText("Fecha de Reporte: ".date("Y/m/d"),12);
$pdf->ezText("<b>Periodo: del </b> ".$fechaInicio." Al ".$fechaFin,10);
//-----------------recuadro que muestra los detalles de venta de la factura------------------------------//
$pdf->ezText("\n\n",10);
$pdf->ezTable($data,$titles,'',array('showHeadings'=>1,'showLines'=>1,'shaded'=>1,'colGap' => 1,'fontSize' =>10,'lineCol' =>'0.3,0.8,0.1','xPos'=>'right','xOrientation'=>'left','width'=>750,'cols'=>array('laboratorio'=>array('justification'=>'left','width'=>200),'producto'=>array('justification'=>'left','width'=>200))));



$pdf->ezStream();
?>
