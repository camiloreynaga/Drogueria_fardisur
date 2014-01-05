<?php 
//----------conexion---------//
include("conexion.php");
$link = Conectarse();
//----------conexion---------//


//------parametros pasados por la URL-------------
//ninguno
//--------------------------------------------


///-------consulta tabla clientes---------------------//
$consultaDetalle="SELECT p.nombre_producto, p.stock ,p.minimo_stock,l.laboratorio,p.fecha_registro,p.fecha_baja, pr.presentacion,p.precio FROM presentacion pr
INNER JOIN (producto p INNER JOIN laboratorio l ON p.laboratorio=l.id) 
    ON pr.id_presentacion=p.id "; 
$detalle= mysql_query($consultaDetalle,$link);

	$producto=array();
	$stock=array();
	$minimo=array();
	$laboratorio=array();
	$fechaR=array();
	$fechaB=array();
	$presentacion=array();
	$precio=array();
	
	
while($row2=  mysql_fetch_array($detalle))
		{
		array_push($producto,$row2[0]);
		array_push($stock,$row2[1]);
		array_push($minimo,$row2[2]);
		array_push($laboratorio,$row2[3]);
		array_push($fechaR,$row2[4]);
		array_push($fechaB,$row2[5]);
		array_push($presentacion,$row2[6]);
		array_push($precio,$row2[7]);
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
for($j=0;$j<count($producto);$j++)
{

$cont++;
$data[] = array('n'=>$cont,'producto'=>$producto[$j],'stock'=>$stock[$j], 'minimo'=>$minimo[$j],'laboratorio'=>$laboratorio[$j],'fechaR'=>$fechaR[$j],'fechaB'=>$fechaB[$j],'presentacion'=>$presentacion[$j],'precio'=>$precio[$j]);// areglo que almacena Datos 


}


$titles = array('n'=>'<b>Nro</b>','producto'=>'<b>Producto</b>','stock'=>'<b>Stock</b>','minimo'=>'<b>Minimo Stock</b>','laboratorio'=>'<b>Laboratorio</b>','fechaR'=>'<b>Fecha Registro</b>','fechaB'=>'<b>Fecha Baja</b>','presentacion'=>'<b>presentacion</b>','precio'=>'<b>Precio</b>');// asignacion de titulos para cada dato o columna

//-----------------codigo que inserta la imagen o logo ------------------------------//
//$pdf->addJpegFromFile('imagenes/logo.jpg',20,320,150,'70');
$pdf->addJpegFromFile('imagenes/logo.jpg',600,490,180,'80');
//$pdf->setColor(0, 0, 255);
$pdf->ezText("<b>Reporte de Productos -STOCK- </b>\n",25);
$pdf->ezText("Fecha de Reporte: ".date("Y/m/d"),12);

//-----------------recuadro que muestra los detalles de venta de la factura------------------------------//
$pdf->ezText("\n\n",10);
$pdf->ezTable($data,$titles,'',array('showHeadings'=>1,'showLines'=>1,'shaded'=>1,'colGap' => 1,'fontSize' =>10,'lineCol' =>'0.3,0.8,0.1','xPos'=>'right','xOrientation'=>'left','width'=>750,'cols'=>array('laboratorio'=>array('justification'=>'left','width'=>120),'producto'=>array('justification'=>'left','width'=>120))));



$pdf->ezStream();
?>
