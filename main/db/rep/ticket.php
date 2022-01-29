<?php
require_once('tcpdf_include.php');

require_once('../../funciones/conexion.php');
require_once('../../funciones/funcs.php');

if (isset($_POST['ticket'])){

    $timeobj = new DateTimeZone('America/Mexico_City');
    $timeobjeto = new DateTime('now', $timeobj);
    $timetrab = $timeobjeto->format('j/m/y');
    $day = $timeobjeto->format('m-j-y');

/*
SELECT AUTO_INCREMENT - 1 as CurrentId FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'masterprint' AND TABLE_NAME = 'reparaciones'
*/
$sql1 = "SELECT MAX(rep_id) FROM reparaciones";
$rep = $con->prepare($sql1);
$rep->execute();
$rep->store_result();
$rep->bind_result($id);



while($rep->fetch()){
    $sql = "SELECT c.cli_nom, c.cli_ape, c.cli_tel, r.rep_imp, r.rep_mod, r.rep_falla FROM reparaciones r INNER JOIN clientes c ON r.cli_id = c.cli_id WHERE r.rep_id = $id";
}

$res = $con->prepare($sql);
$res->execute();
$res->store_result();
$error = array();



if ($res->num_rows>0) {
    //$res->bind_result($rep_id,$cliente,$impresora,$modelo,$serial,$falla,$status,$tecnico,$diagnostico,$costo,$fechai,$aviso,$garantia,$fechaf);
    $res->bind_result($cliente,$apellido,$telefono,$imp_marca,$imp_modelo,$falla);

    $sql2 = "SELECT COUNT(*) FROM `reparaciones` WHERE rep_date LIKE '$day%'";
$rep2 = $con->prepare($sql2);
$rep2->execute();
$rep2->store_result();
$rep2->bind_result($total);

    while ($res->fetch() && $rep2->fetch()){

    




// create new PDF document
$width = 200;//150
$height = 320;//320
$pageLayout = array($width, $height); //  or array($height, $width) 
$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Carlos');
$pdf->SetTitle('Ticket->'.$total);
$pdf->SetSubject('Masterprint');
$pdf->SetKeywords('maquina, falla, fecha, hora, cliente');






// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 100/*PDF_HEADER_LOGO_WIDTH*/, '', '',/*PDF_HEADER_STRING,*/ array(0,0,0), array(0,0,0));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, 0);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(10);


// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>0, 'blend_mode'=>'Normal'));

// Set some content to print<a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!



$html = <<<EOD
<i style="margin-top:-10px;"><span  style= "font-size:80px; text-align:right;">->>>2-32-60-12</span></i>
<i style="margin-top:-40px;"><br/>-- cliente: <span  style= "font-size:80px; text-align:right;"><br/> $cliente $apellido <br>$telefono</span></i><br/>
<i style="float:left;">-- Equipo:<span  style= "font-size:80px; text-align:right;"><br/> $imp_marca $imp_modelo </span></i><br/>
<i style ="text-align:right;">----$timetrab---</i>
<i style="margin-top:-40px;"><br/>-- falla: <span  style= "font-size:80px; text-align:right;"><br/> $falla</span></i>
<div style="width:40px;padding-left:25px; text-align:right"><i><h6 style= "font-size:60px; ">****Estimado cliente, le informamos: tiene un lapso de 15 dias para retirar su equipo a partir de la fecha acordada, presente esta hoja, sin ella no se hará entrega de su equipo, pasando este periodo el taller no se resposabilizara de los equipos olvidados</h6></i></div><i style ="text-align:center;">----$total---</i>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');



    }




}else {
    echo 'error';
}
}else echo 'error';




?>