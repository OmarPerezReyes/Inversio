<?php
function actual_date ()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . " " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   
    return $date;    
}  
$html = "<table border='1' width='100%' style='border-collapse: collapse;'>
<tr>
    <th>name</th><th>Email</th>
</tr>
<tr>
    <td>home</td>
    <td>pass</td>
</tr>
<tr>
    <td>user</td>
    <td>correo</td>
</tr>
<tr>
    <td>ejemplo</td>
    <td>".actual_date('l jS \of F Y')."</td>
</tr>
</table>";
$filename = "newpdffile";

// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename);