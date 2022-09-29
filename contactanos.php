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
    <title>Pizzatoulli</title>

    <!-- LINK  -->
    <link rel="stylesheet" href="./css/usuario_style.css">

    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>

    <link rel="icon" href="./img/logo_icons.png">

    <!-- CHAT BOT -->
    <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>

</head>

<body>
 
        <?php include './front_header.php' ?>

        <section class="contacto">

            <div class="flex">

                <div class="image">
                    <img src="./img/contact-img.svg" alt="">
                </div>

                <form action="https://formsubmit.co/u18215194@gmail.com" method="post">
                    <h3>Contactanos!</h3>
                    <input type="hidden" name="_next" value="https://yourdomain.co/thanks.html">
                    <input type="text" name="nombre" maxlength="50" class="box" placeholder="Ingresa tu nombre" required>
                    <input type="number" name="celular" min="0" max="9999999999" class="box" placeholder="Ingresa tu celular" required maxlength="10">
                    <input type="email" name="correo" maxlength="50" class="box" placeholder="Ingresa tu correo" required>
                    <textarea name="mensaje" class="box" required placeholder="Ingresa tu mensaje" maxlength="500" cols="30" rows="10"></textarea>
                    <input type="submit" value="Enviar Mensaje" name="send" class="btn">
                </form>

            </div>

        </section>


        <?php include './front_footer.php' ?>
        

    <script src="./js/index.js"></script>
</body>

</html>