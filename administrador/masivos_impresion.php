<?php require_once('../clases/cargomasivo_data.php');
$cargo = new  cargomasivodata();
//$empresas = new  empresasdata();
//$auxiliares = new  auxiliaresdata();


$rs=$cargo->cargomasivo_listar_impresion($_REQUEST['reporte'],$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['estado'],'');
//============================================================+ 
// File name   : example_003.php 
// Begin       : 2008-03-04 
// Last Update : 2008-10-10 
//  
// Description : Example 003 for TCPDF class 
//               Custom Header and Footer 
//  
// Author: Nicola Asuni 
//  
// (c) Copyright: 
//               Nicola Asuni 
//               Tecnick.com s.r.l. 
//               Via Della Pace, 11 
//               09044 Quartucciu (CA) 
//               ITALY 
//               www.tecnick.com 
//               info@tecnick.com 
//============================================================+ 

/** 
 * Creates an example PDF TEST document using TCPDF 
 * @package com.tecnick.tcpdf 
 * @abstract TCPDF - Example: Custom Header and Footer 
 * @author Nicola Asuni 
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com 
 * @link http://tcpdf.org 
 * @license http://www.gnu.org/copyleft/lesser.html LGPL 
 * @since 2008-03-04 
 */ 

require_once('../impresion/tcpdf/config/lang/eng.php');
require_once('../impresion/tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer 
/* class MYPDF extends TCPDF { 
    //Page header 
   public function Header() { 
        // Logo 
       $this->Image(K_PATH_IMAGES."logo_example.jpg",10,8,15); 
        // Set font 
        $this->SetFont('helvetica','B',20); 
        // Move to the right 
        $this->Cell(80); 
        // Title 
        $this->Cell(30,10,'Title',0,0,'C'); 
        // Line break 
        $this->Ln(20);
    } 
     
    // Page footer 
    public function Footer() { 
       // Position at 1.5 cm from bottom 
        $this->SetY(-15); 
        // Set font 
        $this->SetFont('helvetica','I',8); 
        // Page number 
        $this->Cell(0,10,'Page '.$this->PageNo().'/'.$this->getAliasNbPages(),0,0,'C');
    } 
} */




// create new PDF document 
$pdf = new TCPDF('P', 'cm', 'OFICIO', true);  
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);  

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Creativa Pixel'); 
$pdf->SetTitle('PERU MAIL EXPRESS'); 
$pdf->SetSubject('Cargos masivos'); 
$pdf->SetKeywords('Peru Mail Express, Cargos Masivos'); 

// set default header data 
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 

// set header and footer fonts 
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

//set margins 
$pdf->SetMargins(0.3, 0.6, 0.4); //izq, arriba, derecha
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 

//$pdf->SetFooterMargin(1000); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, 0.2); 

//set image scale factor 
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 
$pdf->setLanguageArray($l);  

//initialize document 
$pdf->AliasNbPages(); 

// add a page 
$pdf->AddPage(); 

// --------------------------------------------------------- 

// set font 
$pdf->SetFont('helvetica', '',6); 

// print a line using Cell()



/*for ($a=0;$a<=40;$a++)
{
$datos[$a]['0']='A';
$datos[$a]['1']='B';
$datos[$a]['2']='C';
$datos[$a]['3']='D';
$datos[$a]['4']='F';
$datos[$a]['5']='G';
$datos[$a]['6']='H';
} */

$style = array(
    "position" => "C",
    //"border" => true,
    //"padding" => 4,
    "fgcolor" => array(0,0,0),
    "bgcolor" => false, //array(255,255,255),
    //"text" => true,
    //"font" => 'helvetica',
    //"fontsize" => 8,
    //"stretchtext" => 4
);



$a=0;

while($campo =mysql_fetch_array($rs)) {

$datos[$a]['0']=$campo['cmas_id'];
$datos[$a]['1']=$cargo->util->obtienefecha($campo['cmas_fecha']);
$datos[$a]['2']=strtoupper($campo['emprem_razonsocial']);
$datos[$a]['3']=strtoupper($campo['area_descripcion']);
$datos[$a]['4']=strtoupper($campo['cmas_destinatario']);
$datos[$a]['5']=strtoupper($campo['cmas_direccion'].' '.$campo['cmas_caserio']);
$datos[$a]['6']=strtoupper($campo['cmas_ciudad']);

$a=$a+1;

}


$nfilas=1;
for ($f=0;$f<=$a;$f++)
{

		//primera fila
		$pdf->Cell(6.4,1,"",0,0,'C');//LOGO
		$pdf->Cell(0.8,1,"",0,0,'C');
		$pdf->Cell(6.4,1,"",0,0,'C');//LOGO
		$pdf->Cell(0.8,1,"",0,0,'C');
		$pdf->Cell(6.4,1,"",0,0,'C');//LOGO							
		$pdf->Ln();

		
		//segunda fila
		
		$fila=$f;
		$pdf->Cell(1.2,0.4,"",0,0,'C');		
		$pdf->Cell(2.4,0.4,"". $datos[$fila][1] ."",0,0,'C');//fecha
		$pdf->Cell(0.5,0.4,"",0,0,'C');			
		$pdf->Cell(2.3,0.4,"". $datos[$fila][0] ."",0,0,'C');//id
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;
		$pdf->Cell(1.2,0.4,"",0,0,'C');		
		$pdf->Cell(2.4,0.4,"". $datos[$fila][1] ."",0,0,'C');//fecha
		$pdf->Cell(0.5,0.4,"",0,0,'C');			
		$pdf->Cell(2.3,0.4,"". $datos[$fila][0] ."",0,0,'C');//id
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');			
		
		$fila=$f+2;
		$pdf->Cell(1.2,0.4,"",0,0,'C');		
		$pdf->Cell(2.4,0.4,"". $datos[$fila][1] ."",0,0,'C');//fecha
		$pdf->Cell(0.5,0.4,"",0,0,'C');			
		$pdf->Cell(2.3,0.4,"". $datos[$fila][0] ."",0,0,'C');//id
			
			
		$pdf->Ln();

		//tercera fila
		$fila=$f;
		$pdf->Cell(1.5,0.4,"",0,0,'C');			
		$pdf->Cell(4.9,0.4,"".$datos[$fila][2]."",0,0,'C');//empresa
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;		
		$pdf->Cell(1.5,0.4,"",0,0,'C');			
		$pdf->Cell(4.9,0.4,"".$datos[$fila][2]."",0,0,'C');//empresa
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');			

		$fila=$f+2;		
		$pdf->Cell(1.5,0.4,"",0,0,'C');			
		$pdf->Cell(4.9,0.4,"".$datos[$fila][2]."",0,0,'C');//empresa
		

			
		$pdf->Ln();

		//cuarta fila
		$fila=$f;	
		$pdf->Cell(0.9,0.4,"",0,0,'C');					
		$pdf->Cell(5.5,0.4,"".$datos[$fila][3]."",0,0,'C');//area
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;		
		$pdf->Cell(0.9,0.4,"",0,0,'C');					
		$pdf->Cell(5.5,0.4,"".$datos[$fila][3]."",0,0,'C');//area
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');			

		$fila=$f+2;		
		$pdf->Cell(0.9,0.4,"",0,0,'C');					
		$pdf->Cell(5.5,0.4,"".$datos[$fila][3]."",0,0,'C');//area
		

			
		$pdf->Ln();

		//quinta fila
		$fila=$f;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][4]."",0,0,'C');//nombre o detinatario
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][4]."",0,0,'C');//nombre o detinatario
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		

		$fila=$f+2;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][4]."",0,0,'C');//nombre o detinatario
			
		$pdf->Ln();

		//sexta fila
		$fila=$f;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][5]."",0,0,'C');//direccion
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][5]."",0,0,'C');//direccion
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');			

		$fila=$f+2;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][5]."",0,0,'C');//direccion
		
			
		$pdf->Ln();
		
		//septima fila
		$fila=$f;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][6]."",0,0,'C');//distrito
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');		
		
		$fila=$f+1;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][6]."",0,0,'C');//distrito
		
		$pdf->Cell(0.8,0.4,"",0,0,'C');			

		$fila=$f+2;		
		$pdf->Cell(6.4,0.4,"".$datos[$fila][6]."",0,0,'C');//distrito
			
		$pdf->Ln();
		

		//octava fila
		//$fila=$f;
		$pdf->Cell(6.4,3.3,"",0,0,'C');
		
		$pdf->Cell(0.8,3.3,"",0,0,'C');		
		//$fila=$f+1;	
		$pdf->Cell(6.4,3.3,"",0,0,'C');
		
		$pdf->Cell(0.8,3.3,"",0,0,'C');			
		//$fila=$f+2;	
		$pdf->Cell(6.4,3.3,"",0,0,'C');
			
		$pdf->Ln();		
		
		
		//novena fila CODIGO DE BARRAS
		$fila=$f;		

		$pdf->write1DBarcode("". $datos[$fila][0] ."", "C39", '', '', 6.4, 0.5, 0.03,$style, 'M');
 
		
		$pdf->Cell(0.8,0.7," ",0,0,'C');		
		
		$fila=$f+1;		
		
		$pdf->write1DBarcode("". $datos[$fila][0] ."", "C39", '', '', 6.4, 0.5, 0.03,$style, 'M');		
		$pdf->Cell(0.8,0.7," ",0,0,'C');		

		$fila=$f+2;		

		$pdf->write1DBarcode("". $datos[$fila][0] ."", "C39", '', '', 6.4, 0.5, 0.03,$style, 'M');

		$pdf->Cell(0.8,0.7," ",0,0,'C');
			
		$pdf->Ln();				
				
		if ($nfilas<=3)
		{
			//fila margen 
			$pdf->Cell(6.4,0.8,"",0,0,'C');
			$pdf->Cell(0.8,0.8,"",0,0,'C');
			$pdf->Cell(6.4,0.8,"",0,0,'C');
			$pdf->Cell(0.8,0.8,"",0,0,'C');
			$pdf->Cell(6.4,0.8,"",0,0,'C');					
			$pdf->Ln();
		
			$nfilas=$nfilas+1; 
		}
		else
		{
			$nfilas=1;
		}
		
		$f=$f+2;		
}

//$cargo->con->cerrar();


// --------------------------------------------------------- 

//Close and output PDF document 
$pdf->Output('masivos.pdf', 'I'); 

//============================================================+ 
// END OF FILE        o                                          
//============================================================+ 
?>
