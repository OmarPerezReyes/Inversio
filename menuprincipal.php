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
    <title>Menú</title>

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
                <img src="assets/img/logoPrincipalBlanco.png" />
            </div>
        </a>
        <div class="support">
            <a href="soporte.php"> <img src="assets/img/soporteTecnico.png"></img>
            </a>
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
            <a href="miPerfil.php"><img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg" /></a>
            <h4>Usuario</h4>
        </div>

        <div class="options__menu">

            <a href="menuPrincipal.php" class="selected">
                <div class="option">
                    <i class="icon-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <a href="miPerfil.php">
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
        <div class="Contenedores">
            <div class="dineroDisponible">
                <p>Dinero disponible:</p>
                <div class="dinero">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <input id=elpassword type=password class="dineroVer" value=$00000000 placeholder=password readonly/>
                    <svg id=clickme width=28 height=25 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M569.354 231.631C512.97 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-102.556 0-192.091-54.701-240-136 44.157-74.933 123.677-127.27 216.162-135.007C273.958 131.078 280 144.83 280 160c0 30.928-25.072 56-56 56s-56-25.072-56-56l.001-.042C157.794 179.043 152 200.844 152 224c0 75.111 60.889 136 136 136s136-60.889 136-136c0-31.031-10.4-59.629-27.895-82.515C451.704 164.638 498.009 205.106 528 256c-47.908 81.299-137.444 136-240 136z"/></svg>

                </div>
                <p>Detalles de cuenta:</p>
                <a href="estadoCuenta.php"><input type="submit" value="Descargar estado de cuenta" class="btnEstadoC"></a>
                <div class="boton_personalizado">
                    <input type="submit" value="Ingresar Dinero" class="btnMenu">
                    <input type="submit" value="Retirar Dinero" class="btnMenu">
                </div>
            </div>
            <div class="tuActividad">
                <div class="busqueda">
                    <form action="" method="post">
                        <input type="search" name="" id="">
                    </form>
                </div>
                <div class="actividades">
                <div class="icono">
                    aqui va un icono
                </div>
                <div class="descripcion_cant_fecha">
                    <div class="descip_cant">
                        <p>Te transfirieron</p>
                        <p>$500.00</p>
                    </div>
                    <div class="fecha">
                        <p>22 de noviembre</p>
                    </div>
                </div>
            </div>
            <div class="actividades">
                <div class="icono">
                    aqui va un icono
                </div>
                <div class="descripcion_cant_fecha">
                    <div class="descip_cant">
                        <p>Te transfirieron</p>
                        <p>$500.00</p>
                    </div>
                    <div class="fecha">
                        <p>22 de noviembre</p>
                    </div>
                </div>
            </div>
            <div class="actividades">
                <div class="icono">
                    aqui va un icono
                </div>
                <div class="descripcion_cant_fecha">
                    <div class="descip_cant">
                        <p>Te transfirieron</p>
                        <p>$500.00</p>
                    </div>
                    <div class="fecha">
                        <p>22 de noviembre</p>
                    </div>
                </div>
            </div>
            <div class="actividades">
                <div class="icono">
                    aqui va un icono
                </div>
                <div class="descripcion_cant_fecha">
                    <div class="descip_cant">
                        <p>Te transfirieron</p>
                        <p>$500.00</p>
                    </div>
                    <div class="fecha">
                        <p>22 de noviembre</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="tarjetas">
                <p>Mis tarjetas:</p>
                <div class="flecha">
                    <input type="submit" value="+" class="btnFlecha">
                </div>
                <div class="content-tarjeta">
                    <img src="assets\img\tarjetaDebito.png" alt="tarjeta">
                </div>
            </div>
        </div>
    </main>
    <section id="footer">
        <div class="footer contenedor">
            <div class="marca">
                <center>
                    <h1><span>I</span>NVERSIO</h1>
                </center>
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