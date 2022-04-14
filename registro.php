<?php

require 'controllers/database.php';

$message = '';

if (
    !empty($_POST['usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellidoPaterno']) && !empty($_POST['apellidoMaterno'])
    && !empty($_POST['fechaNacimiento']) && !empty($_POST['numeroTelefono']) && !empty($_POST['curp'])
    && !empty($_POST['correo']) && !empty($_POST['pass'])
) {
    $sql = "INSERT INTO cliente (usuario, nombre, apellido_paterno, apellido_materno, fecha_nacimiento,
    telefono_celular, curp, correo, pass, identificacion_oficial, firma) VALUES (:usuario, :nombre, :apellido_paterno, :apellido_materno, :fecha_nacimiento,
    :telefono_celular, :curp, :correo, :pass, :identificacion_oficial, :firma)";
    $stmt = $conexion->prepare($sql);
    $usuario = $_POST["usuario"];

    $recordsDuplicado = $conexion->prepare('SELECT id_cliente FROM cliente WHERE usuario = :usuario');
    $recordsDuplicado->bindParam(':usuario', $_POST['usuario']);
    $recordsDuplicado->execute();
    $resultsDuplicado = $recordsDuplicado->fetch(PDO::FETCH_ASSOC);

    if ($resultsDuplicado['id_cliente'] == null or false) {
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellido_paterno', $_POST['apellidoPaterno']);
        $stmt->bindParam(':apellido_materno', $_POST['apellidoMaterno']);
        $stmt->bindParam(':fecha_nacimiento', $_POST['fechaNacimiento']);
        $stmt->bindParam(':telefono_celular', $_POST['numeroTelefono']);
        $stmt->bindParam(':curp', $_POST['curp']);
        $stmt->bindParam(':correo', $_POST['correo']);
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $stmt->bindParam(':pass', $pass);
        if ($_FILES['identificacionOficial']['error'] > 0) {
            echo '
        <script>
            alert("Error al cargar el archivo. Por favor intente de nuevo.");
        </script>
        ';
        } else {
            $permitido = array("application/pdf", 'image/jpg');
            if (in_array($_FILES['identificacionOficial']['type'], $permitido)) {
                $ruta = 'assets/files/';
                opendir($ruta);
                $_FILES['identificacionOficial']['name'] = $usuario . "_identificacionOficial.pdf";
                $credencial = $ruta . $_FILES['identificacionOficial']['name'];
                copy($_FILES['identificacionOficial']['tmp_name'], $credencial);
                if (!file_exists($ruta)) {
                    mkdir($ruta);
                }
            } else {
                echo '
            <script>
                alert("Tipo de archivo pdf no permitido.");
            </script>
            ';
            }
        }
        $stmt->bindParam(':identificacion_oficial', $credencial);

        $img = $_POST['firma'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = $usuario . '_firma.png';

        $ruta = 'assets/files/';
        opendir($ruta);
        $firma = $ruta . $fileName;
        copy($_POST['firma'], $firma);
        if (!file_exists($ruta)) {
            mkdir($ruta);
        }

        $stmt->bindParam(':firma', $firma);

        if ($stmt->execute()) {
            //TABLA cuenta_bancaria: 
            /* numero_cuenta(20): entidad_financiera, codigo_oficina, control, cuenta
            ° 4 código de la entidad financiera por el Banco Central 
            ° 4 código de la oficina donde abrió la cuenta 
            ° 2 dígitos de control 
            ° 10 dígitos asignados para numerar la cuenta 
         */
            $entidad_financiera = 1427;
            settype($entidad_financiera, "string");
            $codigo_oficina = 1039;
            settype($codigo_oficina, "string");
            $control = rand(10, 99);
            settype($control, "string");
            $cuenta = rand(1000000000, 9999999999);
            settype($cuenta, "string");
            $cuenta_bancaria = "$entidad_financiera$codigo_oficina$control$cuenta";

            /* clabe interbancaria(19): entidad_bancaria, codigo_ciudad, cuenta2, verificacion 
           ° 3 entidad bancaria 
           ° 3 ciudad donde se encuentra la cuenta 
           ° 11 dígitos número de cuenta 
           ° 1 número de verificación 
        */
            $entidad_bancaria = 139;
            settype($entidad_bancaria, "string");
            $codigo_ciudad = 870;
            settype($codigo_ciudad, "string");
            $cuenta2 = rand(1000000000, 2147483647);
            settype($cuenta2, "string");
            $verificacion = rand(0, 9);
            settype($verificacion, "string");
            $clabe = "$entidad_bancaria $codigo_ciudad $cuenta2 $verificacion";


            $sqlDos = "INSERT INTO cuenta_bancaria (id_numero_cuenta, id_cliente, clabe) VALUES (:id_numero_cuenta, :id_cliente, :clabe)";
            $stmtDos = $conexion->prepare($sqlDos);

            $records = $conexion->prepare('SELECT id_cliente FROM cliente WHERE usuario = :usuario');
            $records->bindParam(':usuario', $_POST['usuario']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            $idCliente = $results['id_cliente'];
            $stmtDos->bindParam(':id_numero_cuenta', $cuenta_bancaria);
            $stmtDos->bindParam(':id_cliente', $idCliente);
            $stmtDos->bindParam(':clabe', $clabe);

            echo "<script>console.log('Usuario registrado correctamente' );</script>";

            if ($stmtDos->execute()) {
                //TABLA tarjeta_debito: 
                /* id_numero_tarjeta_debito(19): entidad_bancaria_debito, cuenta2, verificador 
            ° 6 entidad bancaria que emite la tarjeta y ciudad 
            ° 11 dígitos número de la tarjeta ($cuenta2)
            ° 1 dígito verificador 
        
        
         $entidad_bancaria_debito = 128755;
                settype($entidad_bancaria_debito, "string");
                $verificador = rand(0, 9);
                settype($verificador, "string");
                $numero_tarjeta_debito = "$entidad_bancaria_debito$cuenta2$verificador";
                /*id_numero_cuenta(10) 
            $cuenta
                $num_cuenta = $cuenta;
                //saldo(5) 

                //fecha_apertura 
                $fecha_apertura = date("y-m-d");
                //fecha_expiracion 
                $saldo = 0;
                //cvv(4) 
                $cvv = rand(1000, 9999);

                //nip(4) 
                $nip = rand(1000, 9999);

                //limite_movimientos(70) 
                $limite_movimientos = 70;

                //limite_retiros(35)
                $limite_retiros = 35;
                $sqlTres = "INSERT INTO tarjeta_debito (id_numero_tarjeta_debito, id_numero_cuenta, saldo, fecha_apertura, fecha_expiracion, 
            cvv, nip, limite_movimientos, limite_retiros) VALUES (:id_numero_tarjeta_debito, :id_numero_cuenta, saldo, :fecha_apertura, :fecha_expiracion, 
            :cvv, :nip, :limite_movimientos, :limite_retiros)";
                $stmtTres = $conexion->prepare($sqlTres);

                $records = $conexion->prepare('SELECT id_numero_cuenta FROM cuenta_bancaria WHERE id_cliente = :id_cliente');
                $records->bindParam(':id_cliente',  $idCliente);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
                echo $idCliente;
                echo $results['id_numero_cuenta'];
                $stmtTres->bindParam(':id_numero_tarjeta_debito', $numero_tarjeta_debito);
                $stmtTres->bindParam(':id_numero_cuenta', $results['id_numero_cuenta']);
                $stmtTres->bindParam(':saldo', $saldo);
                $stmtTres->bindParam(':fecha_apertura', $fecha_apertura);
                $stmtTres->bindParam(':fecha_expiracion', $fecha_apertura);
                $stmtTres->bindParam(':cvv', $cvv);
                $stmtTres->bindParam(':nip', $nip);
                $stmtTres->bindParam(':limite_movimientos', $limite_movimientos);
                $stmtTres->bindParam(':limite_retiros', $limite_retiros);*/
                echo "<script>console.log('Cuenta creada con éxito' );</script>";
                header("location: iniciarSesion.php");

                if ($stmtTres->execute()) {
                    echo "<script>console.log('Tarjeta de débito asignada con éxito' );</script>";
                } else {
                    echo "<script>console.log('Ha ocurrido un error en la asignación de la tarjeta' );</script>";
                }
            } else {
                echo "<script>console.log('Ha ocurrido un error al crear la cuenta' );</script>";
            }
        } else {
            echo "<script>console.log('Ha ocurrido un error en el registro' );</script>";
        }
    } else {
        echo "<script>alert('Usuario ya existente' );</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/registro.css">
    <script src="assets/js/firma.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        function generarImagen() {
            const enlace = document.createElement('a');
            // El título
            enlace.download = "Firma.png";
            // Convertir la imagen a Base64 y ponerlo en el enlace
            enlace.href = $canvas.toDataURL();
            // Hacer click en él
            document.getElementById("firmaImagen").value = enlace;
        };
    </script>
</head>

<body>
    <a id="Regresarboton" href="./index.html"><i class="fa fa-chevron-circle-left" style="font-size:48px" id="Regresar"></i></a>
    <a id="inversioLogo" href="index.html"><img src="assets/img/logoPrincipalBlanco.png" id="logoPrincipal"></a>

    <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="contenido-login">
        <form action="registro.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <img src="assets/img/avatar.png">
            <h2 class="title">Únete a Inversio</h2>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Usuario</h5>
                    <input required type="text" name="usuario" class="input" pattern="^[a-zA-Z]+$" title="El usuario no debe contener acentos, números ni espacios en blanco">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Nombre</h5>
                    <input required type="text" name="nombre" class="input" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" title="El nombre no puede contener carácteres especiales o números" title="revisa">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido paterno</h5>
                    <input required type="text" name="apellidoPaterno" class="input" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" title="El apellido no debe contener carácteres especiales o números">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido materno</h5>
                    <input required type="text" name="apellidoMaterno" class="input" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" title="El apellido no debe contener carácteres especiales o números">
                </div>
            </div>

            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="fas fa-birthday-cake" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Fecha de nacimiento</h5>
                    <input required type="date" name="fechaNacimiento" class="input" name="" min="1925-01-01" max="2004-12-31">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Número de teléfono</h5>
                    <!--BUSCAR LIMITAR EL TELEFONO-->
                    <input required type="number" name="numeroTelefono" class="input" maxlength="10" oninput="maxlengthNumber(this);" pattern="[0-9]{9}" title="El número telefónico debe ser de 10 digitos">
                    <!-- <input type="number" id="tentacles" name="tentacles" min="10" max="100"> -->
                    <!-- <input name=numero type=text maxlength=7> -->
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-home" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>CURP</h5>
                    <input required type="text" name="curp" class="input" maxlength=18 pattern="[A-Za-z0-9]{18}" title="La CURP son 18 carácteres donde solo puede contener letras y números" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Correo</h5>
                    <input required type="email" name="correo" class="input">
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input id="contrasena" required type="password" name="pass" class="input" autocomplete="new-password" minlength="8" maxlength=15 title="Considere al menos una letra y debe contener al menos un dígito (de 8 a 15 caracteres)" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Confirmar contraseña</h5>
                    <input id="contrasenaConfirm" oninput="confirmar();" required type="password" name="pass_dos" class="input" autocomplete="new-password" minlength="8" maxlength=15 title="Asegurese de ingresar la misma contraseña." required>
                </div>
            </div>
            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="far fa-address-card" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Identificación oficial</h5>
                    <label class="file">
                        <input type="file" name="identificacionOficial" id="file" accept="application/pdf" onchange="fileChoose(event,this)" aria-label="File browser example">
                        <span class="file-custom" data-after="Credencial de elector"></span>
                    </label>
                </div>
            </div>
            <span class="d-block pb-2">Firma digital aqui</span>
            <div class="signature mb-2" style="width: 100%; height: 200px;">
                <canvas id="signature-canvas" style="border: 1px black; background-color:white;width: 100%; height: 200px;"></canvas>
            </div>
            <button class="borrar" type="button" id="btnLimpiar">Borrar</button>
            <div class="caja">
                <label><input required type="checkbox" id="check" name="cbox12" disable="true"> Acepto términos y condiciones</label>
            </div>
            <input type="hidden" id="firmaImagen" name="firma">
            <input required type="submit" id="btnDescargar" class="btn" onclick="generarImagen()">
        </form>
    </div>
    <script src="assets/js/borrarFirma.js"></script>
    <script src="assets/js/generarImagen.js"></script>
</body>
<script type="text/javascript" src="assets/js/main.js"></script>

</html>