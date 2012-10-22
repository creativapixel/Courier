<?php  
require('../impresion/fpdf2.php');  

//aqui la consulta o lo que sea... 


    $pdf=new FPDF();  
    $pdf->AddPage();  
    $pdf->SetFont('Arial','B','10');  

 //titulos de las tabals..... 
/*    $pdf->Cell(60,20,'Ultim Control',C); 
    $pdf->Cell(20,20,'Vaca/Codi'); 
    $pdf->Cell(50,10,'Datacontrol'); 
    $pdf->Cell(25,5,'LLET'); 
*/
//resultados de la consulta a la BD 

//while($row = mysql_fetch_array($result)) {  

for ($i=1;$i<=10;$i++){
    
    $pdf->Cell(20,20,'a',1,0); 
       $pdf->Cell(50,20,'b',1,0);
	       $pdf->Ln(20);  
    $pdf->Cell(25,5,'c',1,0);  
     
     
     
     
     $i=$i+1;
     
    /*$pdf->Cell(60,20,'PDF+PHP Test',); 
rectangle with 60 mm of width & 20 mm of height, we wrote ‘PDF+PHP Test’ and the first 0 means we do not want a border. The 1 next to it means that once it’s done the cell, it will go to the beginning of the next line, if 0 is provided, then it will be to the right of it, if 2 is provided then it will go below. The C is just the alignment which is center of the text inside the box, possible values are left (L), center (C), right (R).*/  
    $pdf->Ln(5);  
     
        } 
  
$pdf->Output();  
/*Now let’s see that code line by line… 

require('fpdf.php'); 
This line includes our FPDF class that we need to create the PDF file. 

$pdf=new FPDF(); 
This line creates a new instance of the FPDF class which will be binded to $pdf 

$pdf->AddPage(); 
This line tells FPDF to add a new page to the PDF file; obviously we need one page so we will call this function once. 

$pdf->SetFont('Arial','B',16); 
This line tells the FPDF class to change the font to Arial, bold, 16 pt. 

$pdf->Cell(40,10,'Hello World!'); 
This line is just like the “echo” of PHP, the text fields in PDF files are just sort of rectangles with text in them, so we want the width of 40 pt. and a height of 10 pt., the third value is the text to be written in that rectangular box.*/ 
?> 