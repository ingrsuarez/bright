<?php

require "FPDF/fpdf.php";
// $enlace = new mysqli("127.0.0.1", "u540644031_suarroda", "Ipac2021", "u540644031_bright", 3306);


class PDF extends FPDF
{
//$numero = date("y").date("m").date("d").$_SESSION['uid'].$_SESSION['pdfprov'][1];	
public $nombreCliente;
public $domicilio;
public $num;
public $fecha;
public $hora;
public $transporte;
public $descripcion;
	
// Cabecera de página
	function Header()
	{
		
		$this->SetFont('Arial','B',18);
		// Calculamos ancho y posición del título.
		$w = 20+6;
		$this->SetX((120-$w)/2);
		// Colores de los bordes, fondo y texto
		$this->SetDrawColor(2,2,2);
		$this->SetFillColor(230,230,0);
		$this->SetTextColor(0,0,0);
		// Ancho del borde (1 mm)
		$this->SetLineWidth(0.4);
		// Logo
		$this->Image('images/logo.jpg',10,8,33);
		$this->Cell(48,10,'',0,0,'R');
		// Arial bold 15
		$this->SetFont('Times','B',18);
		// Título

		$this->Cell(10,7,utf8_decode('R'),1,0,'C');
		$this->Cell(4,10,'',0,0,'R');
		$this->Cell(40,7,'',0,0,'C');
		$this->Cell(40,7,utf8_decode(' N°').$this -> num,1,0,'L');
		$this->Ln(8);
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(180,15,utf8_decode('REMITO'),0,0,'C');
		$this->Ln(4);
		$this->Cell(180,15,utf8_decode('DOCUMENTO NO VÁLIDO'),0,0,'C');
		$this->Ln(4);
		$this->Cell(180,15,'COMO FACTURA',0,0,'C');
		$this->Ln(10);
		
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(30,10,utf8_decode('Ruta 7 BASE AÑELO'),0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		
		$this->Cell(100,10,'IVA:',0,0,'R');
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(19,10,'Responsable Inscripto',0,0,'L');
		$this->Ln(4);
		
		$this->Cell(30,10,'8305 - NEUQUEN',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(100,10,'CUIT:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,'33-71454972-9',0,0,'L');
		$this->Ln(4);
		
		$this->Cell(30,10,'Mail: verogri@brightsolutionssa.com',0,0,'L');
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(101,10,'Ing. Brutos: ',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(40,10,utf8_decode('000-15988800'),0,0,'L');
		$this->Ln(10);
		

		
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(30,10,utf8_decode($this -> nombreCliente),0,0,'L');
		$this->Cell(100,10,'FECHA:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,$this -> fecha,0,0,'L');
		$this->Ln(4);
		
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(30,10,$this -> domicilio,0,0,'L');
		$this->Cell(100,10,'HORA:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,$this->hora,0,0,'L');
		$this->Ln(4);

		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(30,10,utf8_decode('Cond. Vta.: 30 días'),0,0,'L');
		$this->Cell(100,10,'TRANSPORTISTA:',0,0,'R');
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',10);
		$this->Cell(27,10,utf8_decode($this->transporte),0,0,'L');
		$this->Ln(10);
		$this->SetLineWidth(0.4);
		$this->SetDrawColor(0,0,0);
		$this->Cell(0,0,'','B',0,'L');
		$this->Ln(1);
		$this->Cell(40,7,utf8_decode('Descripción:'),0,0,'L',false);
		$this->SetFont('Times','',10);
		$this->SetTextColor(47,79,79);
		$this->Cell(40,7,utf8_decode($this->descripcion),0,0,'L',false);
		$this->Ln(10);

		$this->Ln(10);
		$this->SetLineWidth(0.4);
		$this->SetDrawColor(0,0,0);
		$this->Cell(0,0,'','B',0,'L');
		$this->Ln(1);
	}

// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,utf8_decode('Página: ').$this->PageNo().'/{nb}',0,0,'R');
	}


}

// if (array_key_exists('pdf',$_POST)) { //Generar PDF
			
	//Proveedor $idprov
	

	// //Listado de articulos a imprimir $ocitems
	
	//Imprimo un pagina por cada Orden de compra
	// $querynoc = "SELECT * from ocpendientes WHERE numero = ".$ocitems;
	// $resultadonoc = mysqli_query($enlace,$querynoc);
	// $row = mysqli_fetch_assoc($resultadonoc);
	
	// $queryp = "SELECT * FROM `proveedores` WHERE `id` = '".$idprov."'";
	// $resultadop = mysqli_query($enlace,$queryp);
	// $filaprov = mysqli_fetch_assoc($resultadop);
	//array datos del proveedor
	
	$cont = 0;
	// $numero = date("Y-m-d");
	// $fecha = substr($numero, 4, 2)."/".substr($numero, 2, 2)."/20".substr($numero, 0, 2);
	// $fecha = 'fecha';
	// $numero = '12';

	$pdf = new PDF("P","mm","A4");
	$pdf-> AliasNbPages();
	$pdf-> nombreCliente = strtoupper($cliente->nombre); 
	$pdf-> num = str_pad($remito->id, 8, "0", STR_PAD_LEFT);
	$pdf-> domicilio = $cliente->domicilio;
	$pdf-> fecha = $remito->fecha;
	$pdf-> hora = $remito->hora;
	if (!empty($movimientos)){
		$pdf-> transporte = $movimientos[0]->transporte;
	}
	
	$pdf-> descripcion = $remito->leyenda;
	$pdf-> AddPage();
	

	$w = array(40, 80, 50);
	$h = array(40, 80, 50, 30);
	$header = array('Equipo',utf8_decode('Horas'),'Capacidad',utf8_decode('Tipo'));
	// $pdf->SetFont('Arial','B',11);
	// // Cabecera
	$pdf->Cell($h[0],7,$header[0],0,0,'L',false);
	$pdf->Cell($h[1],7,$header[1],0,0,'L',false);
	$pdf->Cell($h[2],7,$header[2],0,0,'L',false);
	$pdf->Cell($h[3],7,$header[3],0,0,'L',false);
	$pdf->Ln(7);	
	$pdf->SetLineWidth(0.4);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Cell(0,0,'','B',0,'L');
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',10);
	
	if (!empty($movimientos)){
		foreach ($movimientos as $fila){

			$pdf->Cell($w[0],6,"      ".$fila->equipo,0,0,'L',false);
			$pdf->Cell($w[1],6,substr($fila->horas,0,40),0,0,'L',false);
			$pdf->Cell($w[2],6,substr($fila->capacidad,0,40),0,0,'L',false);
			$pdf->Cell($w[2],6,$fila->tipo,0,0,'L',false);
			$pdf->Ln();
			// $idoc = $movimientos;
			// $queryup = "UPDATE `ordencompra` SET `estatus` = 'enviada' WHERE `ordencompra`.`id` = '".$idoc."'";
			// mysqli_query($enlace,$queryup);
							
		}
	}
		
	
	
	// $pdf->Output("OfficeForm.pdf", "I");





/*session_start();
$proveedor = "MERINO ALEJANDRO RUBEN";
$numero = "132435";
$domicilio = " TUPUNGATO 1085";
$pdf = new PDF("P","mm","A4");
$pdf-> AliasNbPages();
$pdf-> prov = $proveedor; 
$pdf-> num = $numero;
$pdf-> domi = $domicilio;

$pdf-> AddPage();


$w = array(40, 110, 30);
$h = array(40, 110, 35);
$header = array('Cantidad',utf8_decode('Descripción'),utf8_decode('Código'));

		
	
$query = "SELECT * FROM `ordencompra` WHERE `estatus` LIKE 'creada' AND `proveedor` = '".$_SESSION['pdfprov'][0]."'";
$result = mysqli_query($enlace,$query);
$pdf->SetFont('Arial','B',11);
// Cabecera
$pdf->Cell($h[0],7,$header[0],0,0,'L',false);
$pdf->Cell($h[1],7,$header[1],0,0,'L',false);
$pdf->Cell($h[3],7,$header[2],0,0,'L',false);
$pdf->Ln(7);	
$pdf->SetLineWidth(0.4);
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(0,0,'','B',0,'L');
$pdf->Ln(3);
$pdf->SetFont('Arial','',10);
foreach ($_SESSION['pdfocid'] as $idoc) {
		$query = "SELECT * FROM `ordencompra` WHERE `id` = '".$idoc."'";
		$result = mysqli_query($enlace,$query);
		$fila = mysqli_fetch_array($result);
		$pdf->Cell($w[0],6,"      ".$fila[5],0,0,'L',false);
		$pdf->Cell($w[1],6,substr($fila[11],0,40),0,0,'L',false);
		$pdf->Cell($w[2],6,'COD123',0,0,'L',false);
		$pdf->Ln();
		
	}*/
	
$pdf->Output();	
	

exit;

?>
