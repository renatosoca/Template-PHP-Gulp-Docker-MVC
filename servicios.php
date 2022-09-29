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
    <title>Servicios al Cliente</title>

    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./css/usuario_style.css">

    <!-- CHAT BOT -->
    <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>

    <link rel="icon" href="./img/logo_icons.png">
</head>
<body>

    <?php include './front_header.php'; ?>

    <section class="nuestros-servicios">
        <h2 class="title">Nuestros Servicios!</h2>

        <!--DELIVERY-->
        <h2 class="main_title">A tu alcance Siempre</h2>

        <div class="nuestros_servicios">
            <img src="./img/delivery_new.webp" alt="" class="imagen">
            <div class="TEXTO">
                <h3><span>A</span> Tiempo y Velocidad</h3>
                <p>El tiempo es un recurso muy valioso para cualquier ser o entidad, por ello los consumidores no siempre tendrán la capacidad de asisitir a nuetros locales, como solución tenemos el delivery a domicilio, si el pedido tarda mas de lo previsto, entonces es gratis !!!</p>
                <h3><span>B</span> Motorizados y Capacidad</h3>
                <p>Para el cumplimiento de nuestros consumidores a larga o mediana distancia, nuestra pizzería cuenta equipos motorizados en regla, nuestros encargados son capaces de trasladar el pedido de manera rápida y eficiente, sobretodo priorizamos que el exquisito sabor quede intacto !!!!</p>
            </div>
        </div>

        <!--CALIDAD DE LA PIZZA-->
        <h2 class="main_title">Pizzas Sobresalientes</h2>

        <div class="nuestros_servicios">

            <img src="./img/pizza_new.jpg" alt="" class="imagen">

            <div class="TEXTO">
                <h3><span>A</span> Calidad</h3>
                <p>Calidad, es un concepto fundamental para el éxito de cualquier empresa, ya sea que ofrezca, un producto o servicio, en nuestro caso ofrecemos ambos y con una calidad nenvidiosa a la competencia. Nuestras pizzas estan elaboradas con productos importadas de las granjas mas finas, finalmente es el amor y pasión que otorga el toque final a nuestro sabor</p>
                <h3><span>B</span> Nuestros Certificados</h3>
                <p> Nuestras pizzas estan catalogadas en el top 10 de "Piiza Excelent Service", mostrando así nuestra gran capacidad de cocina, los procesos que realizamos estan cuidadas minuciosamente para los estandares requeridos</p>
            </div>

        </div>

        <!--Entretenimiento-->
        <h2 class="main_title">Afuera el Aburrimiento</h2>

        <div class="nuestros_servicios">

            <img src="./img/banda_new.jpg" alt="" class="imagen">

            <div class="TEXTO">
                <h3><span>A</span> Entretenimiento</h3>
                <p>El entorno de trabajo y por supuesto el patio de comidas siempre tiene que poseer un ambiente positivo reservando todos los valores positivos, en cuestión a nuestro patio de comidas, el abrurrimiento es inexiste por nuestras constantes actividades de diversión familiar.</p>
                <h3><span>B</span> Conciertos</h3>
                <p>Conciertos, actividad recreativa familiar que otorga al ambiente movimiento y colorismo en un entorno romanticista, frecuentemente artistas en solitarios y bandas recién nacidas ofrecen deleites musicales en nuestro escenario.</p>
            </div>
        </div>
        
        <!--Sitio Web-->
        <h2 class="main_title">Conócenos </h2>

        <div class="nuestros_servicios">
            <img src="./img/webiste_new.webp" alt="" class="imagen">
            <div class="TEXTO">
                <h3><span>A</span> Que el mundo nos conozca</h3>
                <p>Un sitio web, es un espacio en la internet, red de redes perfecto para el marketing. Nuestra pizzería no se queda atras y constantemente se actualiza con las modas del marketing digital, nuestro sitio consta de un listado de todos nuestros productos, servicios, ofertas y de más, así de maravilloso puede ser la tecnología !!!!</p>
                <h3><span>B</span> Alcance para todos</h3>
                <p>Alcance, sin importar en donde un individuo se encuentre, siempre tendrá la opción de conocer todo, talvez viva cerca de nosotros y aún no se entera. Incluso desde los puntos mas remotos la opcion de conocernos siempre será posible y por que no visitarnos?</p>
            </div>
        </div>

    </section>
    <?php include './front_footer.php' ?>

<script src="./js/index.js"></script>
</body>

</html>
</body>
</html>
