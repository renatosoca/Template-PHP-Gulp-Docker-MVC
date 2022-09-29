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
    <title>Pizzatuille</title>

    <!-- LINK SWIPERS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./css/usuario_style.css">

    <!-- ICONOS -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>


    <link rel="icon" href="./img/logo_icons.png">

    <!-- CHAT BOT -->
    <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>
</head>

<body>
    <div class="main">
    
        <?php include './front_header.php'; ?>
        
        <!-- Presentacion Slider -->
        <div class="home">

            <section class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slider">
                        <div class="image">
                            <img src="./img/slider1.jpg" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slider">
                        <div class="image">
                            <img src="./img/slider2.jpg" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slider">
                        <div class="image">
                            <img src="./img/slider3.jpg" alt="">
                        </div>

                    </div>

                    <div class="swiper-slide slider">
                        <div class="image">
                            <img src="./img/slider4.jpg" alt="">
                        </div>

                    </div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>

            </section>

        </div>

        <!-- Promociones -->
        <section class="pmc">
            <div class="promociones">
                <h2 class="titulo">PROMOCIONES EN LINEA</h2> 
                <div class="pmcju">
                    <div class="promo">
                        <h3 class="titulo_promo">PIZZA NAPOLITANA S/.15!!</h3>    
                        <div class="flex-btn">
                            <a href="./productos.php" class="btn">Comprar</a>
                        </div>
                    </div>
                    <div class="promo">
                        <h3 class="titulo_promo">PIZZA AMERICANA S/.22!!</h3>
                        <div class="flex-btn">
                            <a href="./productos.php" class="btn">Comprar</a>
                        </div>
                    </div>
                    <div class="promo">
                        <h3 class="titulo_promo">PIZZA HAWAINA S/.25!!</h3>
                        <div class="flex-btn">
                            <a href="./productos.php" class="btn">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <?php include './front_footer.php' ?>

        <div class="loader">
            <img src="./img/LoaderPizza.gif" alt="">
        </div>

    </div>

    
    <!-- Funcionalidad a javascript -->
    <script src="./js/index.js"></script>

    <!-- SWIPERJS -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".home-slider", {
          spaceBetween: 30,
          centeredSlides: true,
          loop:true,
          autoplay: {
            delay: 6000,
            disableOnInteraction: false,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        });
    </script>

</body>

</html>