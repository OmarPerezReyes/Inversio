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
</head>

<body>
    <a id="Regresarboton" href="./index.html"><i class="fa fa-chevron-circle-left" style="font-size:48px" id="Regresar"></i></a>
    <a id="inversioLogo" href="index.html"><img src="assets/img/logoPrincipalBlanco.png" id="logoPrincipal"></a>

    <div class="contenido-login">
        <form action="iniciarSesion.html">
            <img src="assets/img/avatar.png">
            <h2 class="title">Únete a Inversio</h2>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Usuario</h5>
                    <input required type="text" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Nombre</h5>
                    <input required type="text" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido paterno</h5>
                    <input required type="text" class="input">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Apellido materno</h5>
                    <input required type="text" class="input">
                </div>
            </div>

            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="fas fa-birthday-cake" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Fecha de nacimiento</h5>
                    <input required type="date" class="input" name="">
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Número de teléfono</h5>
                    <!--BUSCAR LIMITAR EL TELEFONO-->
                    <input required type="number" class="input" onkeydown="if(this.value.length == 10) return false;">
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
                    <input required type="text" class="input" maxlength=18>
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Correo</h5>
                    <input required type="email" class="input" autocomplete="chrome-off">
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input required type="password" class="input" autocomplete="new-password" maxlength=8 pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Considere al menos una letra mayúscula o minúscula. La contraseña debe empezar con una letra y contener al menor un dígito"
                        required>
                </div>
            </div>

            <div class="input-div one arribaDiv">
                <div class="i">
                    <i class="far fa-address-card" aria-hidden="true"></i>
                </div>
                <div class="div">
                    <h5>Identificación oficial</h5>
                    <label class="file">
                        <input type="file"
                               id="file"
                               onchange="fileChoose(event,this)"
                               aria-label="File browser example">
                        <span class="file-custom"
                              data-after="Credencial de elector"></span>
                    </label>
                </div>
            </div>
            <span class="d-block pb-2">Firma digital aqui</span>
            <div class="signature mb-2" style="width: 100%; height: 200px;">
                <canvas id="signature-canvas" style="border: 1px black; background-color:white;width: 100%; height: 200px;"></canvas>
            </div>
            <button type="button" id="btnLimpiar">Borrar</button>
            <button type="button" id="btnDescargar">Descargar</button>
            <div class="caja">
                <label><input required type="checkbox" name="cbox12"> Acepto términos y condiciones</label>
            </div>
            <input required type="submit" class="btn" value="Finalizar">
        </form>
    </div>
    <script src="assets/js/borrarFirma.js"></script>
    <script src="assets/js/generarImagen.js"></script>
</body>
<script type="text/javascript" src="assets/js/main.js"></script>

</html>