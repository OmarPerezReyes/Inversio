<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  session_destroy();
  header('Location: index.html');
}
$nombreImagen = "assets/img/logoPrincipal.jpg";
$imagenBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($nombreImagen));
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

require 'controllers/database.php';

$records = $conexion->prepare('SELECT usuario, nombre, apellido_paterno, apellido_materno, correo, telefono_celular, fecha_nacimiento, curp, firma FROM cliente WHERE id_cliente = :id_cliente');
    $records->bindParam(':id_cliente', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

$filename = $results['usuario'].'_estado_cuenta';
$html="<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='utf-8'>
    <title>".$results['usuario'].' a '.actual_date()."</title>
    <style>
        .clearfix:after {
            content: '';
            display: table;
            clear: both;
        }
        
        a {
            color: #5D6975;
            text-decoration: underline;
        }
        
        body {
            position: relative;
            width: 16cm;
            height: 26cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }
        
        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }
        
        #logo {
            text-align: center;
            margin-bottom: 15px;
        }
        
        #logo img {
            width: 150px;
        }
        #firma {
            text-align: center;
            margin-top: 40px;
        }
        
        #firma img {
            width: 170px;
        }
        
        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }
        
        #project {
            float: left;
        }
        
        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }
        
        #company {
            float: right;
            text-align: right;
        }
        
        #project div,
        #company div {
            white-space: nowrap;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        
        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }
        
        table th,
        table td {
            text-align: center;
        }
        
        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }
        
        table .service,
        table .desc {
            text-align: left;
        }
        
        table td {
            padding: 20px;
            text-align: right;
        }
        
        table td.service,
        table td.desc {
            vertical-align: top;
        }
        
        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }
        
        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }
        
        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }
        
        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <header class='clearfix'>
        <div id='logo'>
            <img src='".$imagenBase64."'>
        </div>
        <h1>ESTADO DE CUENTA</h1>
        <div id='company' class='clearfix'>
            <div>INVERSIO</div>
            <div>Cd.Victoria, Tamaulipas, México<br /> CP 87134</div>
            <div>8343088355</div>
            <div><a href='mailto:inversioGeneral@inversio.com'>inversioGeneral@inversio.com</a></div>
        </div>
        <div id='project'>
            <div><span>Usuario</span>".$results['usuario']."</div>
            <div><span>Nombre Completo</span>".$results['nombre'].' '.$results['apellido_paterno'].' '.$results['apellido_materno']."</div>
            <div><span>CURP</span>".$results['curp']."</div>
            <div><span>Teléfono Celular</span>".$results['telefono_celular']."</div>
            <div><span>CORREO</span><a href='mailto:john@example.com'>".$results['correo']."</a></div>
            <div><span>Fecha de nacimiento</span>".$results['fecha_nacimiento']."</div>
            <div><span>Fecha actual</span>".actual_date()."</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class='service'>SERVICIO</th>
                    <th class='desc'>DESCRIPCIÓN</th>
                    <th>PRECIO</th>
                    <th>CANT</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='service'>Diseño</td>
                    <td class='desc'>Crear una solución de diseño reconocible basada en la identidad visual existente de la empresa.</td>
                    <td class='unit'>$40.00</td>
                    <td class='qty'>26</td>
                    <td class='total'>$1,040.00</td>
                </tr>
                <tr>
                    <td class='service'>Desarrollo</td>
                    <td class='desc'>Desarrollo de un sitio web basado en un sistema de gestión de contenido</td>
                    <td class='unit'>$40.00</td>
                    <td class='qty'>80</td>
                    <td class='total'>$3,200.00</td>
                </tr>
                <tr>
                    <td class='service'>SEO</td>
                    <td class='desc'>Optimizar el sitio para los motores de búsqueda (SEO)</td>
                    <td class='unit'>$40.00</td>
                    <td class='qty'>20</td>
                    <td class='total'>$800.00</td>
                </tr>
                <tr>
                    <td class='service'>Entrenamiento</td>
                    <td class='desc'>Sesiones de formación inicial para el personal responsable de subir contenido web</td>
                    <td class='unit'>$40.00</td>
                    <td class='qty'>4</td>
                    <td class='total'>$160.00</td>
                </tr>
                <tr>
                    <td colspan='4'>SUBTOTAL</td>
                    <td class='total'>$5,200.00</td>
                </tr>
                <tr>
                    <td colspan='4'>IVA 25%</td>
                    <td class='total'>$1,300.00</td>
                </tr>
                <tr>
                    <td colspan='4' class='grand total'>CANTIDAD TOTAL</td>
                    <td class='grand total'>$6,500.00</td>
                </tr>
            </tbody>
        </table>
        <div id='notices'>
            <div>NOTA:</div>
            <div class='notice'>Se realizará un cargo por financiamiento del 1,5% sobre los saldos después de 30 días.</div>
        </div>
    </main>
    <div id='firma'>
            <img src='"."data:image/jpg;base64," . base64_encode(file_get_contents($results['firma']))."'>
        </div>
    <footer>
        ".actual_date()."
    </footer>
</body>

</html>";
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('a4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename);