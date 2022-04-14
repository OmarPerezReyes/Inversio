<?php
session_start();
  if (!isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: index.html');
  }
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/fontello.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<body id="body">
    
    <header>
        <div class="icon__menu">
            <i class="icon-menu" id="btn_open"></i>
        </div>

        <a href="menuPrincipal.php">
            <div class="logoP">
                <img src="assets/img/logoPrincipalBlanco.png"/>
            </div>
        </a>
        <div class="support">
            <a href="soporte.php"> <img src="assets/img/soporteTecnico.png"></img>
        </div>
        <a href="iniciarSesion.php">
            <div class="cerrar_sesion">
                <img src="assets/img/cerrarSesion.png">
            </div>
        </a>
        <p>Cerrar sesion</p>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <a href="miPerfil.php"><img src= "https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg"/></a>
            <h4>Usuario</h4>
        </div>

        <div class="options__menu">	

            <a href="menuPrincipal.php">
                <div class="option">
                    <i class="icon-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <a href="miPerfil.php" class="selected">
                <div class="option">
                    <i class="icon-user-circle" title="Mi Perfil"></i>
                    <h4>Mi Perfil</h4>
                </div>
            </a>

            <a href="transferir.php">
                <div class="option">
                    <i class="icon-credit-card" title="Transferir"></i>
                    <h4>Transferir</h4>
                </div>
            </a>

            <a href="pagarServicio.php">
                <div class="option">
                    <i class="icon-doc" title="Pagar servicio"></i>
                    <h4>Pagar servicio</h4>
                </div>
            </a>

            <a href="suActividad.php">
                <div class="option">
                    <i class="icon-chart-line-1" title="Su actividad"></i>
                    <h4>Su actividad</h4>
                </div>
            </a>

        </div>

    </div>
    <main>
        <div class="miperfil">
            <div class="persona">
                <div class="icono-perfi">
                    <img src="assets/img/miPerfil.png" alt="tarjeta">
                    <h1>Adrian Perez Facundo</h1>
                </div>
            </div>
            <div class="datos">
                <div class="dato">
                    <div class="icono-dato">
                        <img src="assets/img/miPerfil.png" alt="tarjeta">
                    </div>
                    <div class="informacion">
                        <h4>Tu Datos</h4>
                        <P>·ReyesomarP@hotmail.com</P>
                        <P>·CURP</P>
                        <P>·RFC  REPE336789457</P>
                        <P>·834 111 9022</P>
                    </div>
                </div>
                <div class="dato">
                    <div class="icono-dato">
                        <img src="assets/img/seguridad.webp" alt="tarjeta">
                    </div>
                    <div class="informacion">
                        <h4>Seguridad</h4>
                        <P>·SEGURIDAD CONFIGURADA</P>
                    </div>
                </div>
                <div class="dato">
                    <div class="icono-dato">
                        <img src="assets/img/creditCard.png" alt="tarjeta">
                    </div>
                    <div class="informacion">
                        <h4>Tu CLABE</h4>
                        <P>·Beneficiario: Omar Alejandro Perez Reyes</P>
                        <P>·CLABE: 123456543212345678</P>
                        <P>·Banco receptor: Inversio</P>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section id="footer">
        <div class="footer contenedor">
            <div class="marca">
                <center><h1><span>I</span>NVERSIO</h1></center> 
            <h2>Invierte para crear, ahorra para soñar.</h2>
            <div class="social">
              
                <a href="#"><i class="icon-facebook-squared"></i></a>
                <a href="#"><i class="icon-instagram"></i></a>
                <a href="#"><i class="icon-youtube-play"></i></a>
                <a href="#"><i class="icon-twitter"></i></a>
               
            </div>
            
            <div id="footerDos"><a href="#" class="linksPie">Aviso legal</a>
                <a href="#" class="linksPie">Términos y condiciones </a>
                <a href="#" class="linksPie">Aviso de privacidad</a><a href="#" class="linksPie">Contáctanos</a></div>
            <p>Copyright 2022 © Los productos y ofertas de INVERSIO están dirigidos sólo a residentes de México</p>
        </div>
    </section>
    <script src="./assets/js/script.js"></script>
</body>
</html>