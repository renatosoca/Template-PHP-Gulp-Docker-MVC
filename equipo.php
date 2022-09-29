<?php

include './BD/conexion.php';

session_start();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestro Equipo - Pizzatuille</title>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./css/usuario_style.css">

    <!-- SCRIPT FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>


    <link rel="icon" href="./img/logo_icons.png">

    <!-- CHAT BOT -->
    <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>

</head>

<body>

    <?php include 'front_header.php' ?>

    <div class="contenido_equipo">
        
        <section class="testimony">

            <div class="containerr_equipo">

                <h2 class="titulo">NUESTRO EQUIPO DE TRABAJO</h2>

                <div class="testimony-container">

                    <div class="testimony__card">
                        <img src="./img/RenatoSoca.jpeg" class="testimony__img">
                        <div class="testimony__copy">
                            <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                            <div class="testimony__info">
                                <h3 class="testimony__name">Renato Soca</h3>
                                <p class="testimony__position">Estudiante de Ingeniería de Sistemas en UTP</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimony__card">
                        <img src="./img/DenilsonVivanco.jpeg" class="testimony__img">
                        <div class="testimony__copy">
                            <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                            <div class="testimony__info">
                                <h3 class="testimony__name">Denilson Vivanco</h3>
                                <p class="testimony__position">Estudiante de Ingeniería de Sistemas en UTP</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimony__card">
                        <img src="./img/MayferAlexis.jpeg" class="testimony__img">
                        <div class="testimony__copy">
                            <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                            <div class="testimony__info">
                                <h3 class="testimony__name">Mayfer Quispe</h3>
                                <p class="testimony__position">Estudiante de Ingeniería de Sistemas en UTP</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimony__card">
                        <img src="./img/RolyAntony.jpeg" class="testimony__img">
                        <div class="testimony__copy">
                            <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                            <div class="testimony__info">
                                <h3 class="testimony__name">Roly Ari</h3>
                                <p class="testimony__position">Estudiante de Ingeniería de Sistemas en UTP</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimony__card">
                        <img src="./img/EliasCarmin.jpeg" class="testimony__img">
                        <div class="testimony__copy">
                            <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                            <div class="testimony__info">
                                <h3 class="testimony__name">Elías Carmín</h3>
                                <p class="testimony__position">Estudiante de Ingeniería de Sistemas en UTP</p>
                            </div>
                        </div>
                    </div>

                    <div class="testimony__card">
                        <div class="testimony__text">
                            <p class="testimony__history">El grupo 5 elige desarrollar como proyecto final una página web 
                                como negocio una pizzería creada por nosotros nombrada "Ratatouille", puesto que la comida 
                                rápida como esta es un negocio común y factible en nuestra sociedad además de poseer una 
                                amplia gama de opciones para el desarrollo del proyecto.</p>
                            <div class="testimony__copy testimony__copy--modifier">
                                <img src="./img/logo_utp.jfif" class="testimony__logo logo--picture">
                                <div class="testimony__info">
                                    <h3 class="testimony__name">karen Vanessa Corilla Quispe</h3>
                                    <p class="testimony__position">Docente en UTP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <?php include 'front_footer.php'; ?>


    <div class="loader">
        <img src="./img/LoaderPizza.gif" alt="">
    </div>

    <script src="./js/index.js"></script>
    
</body>
</html>