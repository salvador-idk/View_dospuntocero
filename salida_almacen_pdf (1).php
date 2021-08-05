<?php
use \setasign\Fpdi\Fpdi;
require_once('fpdf.php'); 
require_once('fpdi/src/autoload.php'); 
$pdf = new FPDI();

$pdf->AddPage(); 

$pdf->setSourceFile('formato.pdf'); 
// import page 1 
$tplIdx = $pdf->importPage(1); 
//use the imported page and place it at point 0,0; calculate width and height
//automaticallay and ajust the page size to the size of the imported page 
$pdf->useTemplate($tplIdx,['adjustPageSize'=>true]); 






// now write some text above the imported page 
$pdf->SetFont('Arial', '', '10'); 
$pdf->SetTextColor(0,0,0);


//HECHO PROBABLEMENTE DELICTIVO
//set position in pdf document

//FECHA
$fechaderecha=date('d,m,Y', strtotime($_POST['linea1']));
$fechad= str_split(str_replace(",","", $fechaderecha));
for ($i=0;$i<count($fechad);$i++){
    $pdf->SetXY(24.8+($i*4.1), 69);
    $pdf->Write(0,$fechad[$i]);
}
//HORA
$horad= str_split(str_replace(":","", $_POST['linea2']));
for ($i=0;$i<count($horad);$i++){
    if($i<2){
        $pdf->SetXY(81.8+($i*4.1), 69);
    }
    else{
        $pdf->SetXY(85+($i*4.1), 69);
    }
    $pdf->Write(0,$horad[$i]);
}
//No. EXPEDIENTE
$expd= str_split(str_replace("","", $_POST['linea3']));
for ($i=0;$i<count($expd);$i++){
    $pdf->SetXY(141.6+($i*4.1), 69);
    $pdf->Write(0,$expd[$i]);
}
//Equis en el cuadrito A
if (isset($_POST["anexoA"])){
    $pdf->SetXY(65, 83);
    $pdf->Write(0, 'X');
}
//Equis en el cuadrito B
if (isset($_POST["anexoB"])){
    $pdf->SetXY(65, 89.5);
    $pdf->Write(0, 'X');
}
//Equis en el cuadrito C
if (isset($_POST["anexoC"])){
    $pdf->SetXY(65, 95.5);
    $pdf->Write(0, 'X');
}
//DATOS DE QUIEN REALIZA LA PUESTA A DISPOSICION
//Primer apellido
$pdf->SetXY(40, 134);
$pdf->Write(0, $_POST['linea4']);
//Segundo apellido
$pdf->SetXY(40, 139);
$pdf->Write(0, $_POST['linea5']);
//Nombre(s)
$pdf->SetXY(40, 144);
$pdf->Write(0, $_POST['linea6']);
//Adscripcion   
$pdf->SetXY(40, 149);
$pdf->Write(0, $_POST['linea7']);
//Cargo/Grado
$pdf->SetXY(40, 154);
$pdf->Write(0, $_POST['linea8']);
//Firma
$pdf->SetXY(40, 160);
$pdf->Write(0, $_POST['linea9']);

//force the browser to download the output
$pdf->Output('modificado.pdf', 'D');
 ?>