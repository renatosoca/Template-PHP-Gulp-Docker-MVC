<?php

include './BD/conexion.php';

    session_start();

    if(isset($_SESSION['usuario_id'])){
        $usuario_id = $_SESSION['usuario_id'];
    }else{
        $usuario_id = '';
    };

    if(isset($_POST['agre_carrito'])){

        if($usuario_id == ''){
        $mensaje[] = 'Por favor, Primero inicia sesión!!';
        }else{
    
        $pid = $_POST['p_id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];
        $cantidad = $_POST['cantidad'];
        $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);
    
        $select_cart = $conn->prepare("SELECT * FROM `carrito` WHERE usuario_id = ? AND nombre = ?");
        $select_cart->execute([$usuario_id, $nombre]);
    
        if($select_cart->rowCount() > 0){
            $mensaje[] = 'Producto ya agregado al carrito';
        }else{
            $insert_cart = $conn->prepare("INSERT INTO `carrito`(usuario_id, pid, nombre, precio, cantidad, imagen) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$usuario_id, $pid, $nombre, $precio, $cantidad, $imagen]);
            $mensaje[] = 'Producto agregado!';
        }
    
        }
    
    }

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzatuille</title>

    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="./css/usuario_style.css">

    <!-- CHAT BOT -->
    <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>

    <link rel="icon" href="./img/logo_icons.png">

</head>

<body>


    <?php include './front_header.php' ?>

    <section class="mostrar_productos">

        <h1 class="titulo">Productos "Pizzatuille"</h1>

        <div id="home" class="container">

            <?php
                $select_productos = $conn->prepare("SELECT * FROM `productos`");
                $select_productos->execute();
                if($select_productos->rowCount() > 0){
                    while($fetch_productos = $select_productos->fetch(PDO::FETCH_ASSOC)){ 
            ?>

            <div class="box">
                <div class="precio">S/. <?= $fetch_productos['precio']; ?></div>
                <img src="./img_productos/<?= $fetch_productos['imagen']; ?>" alt="imagen producto <?= $fetch_productos['nombre']; ?>">
                <div class="nombre"><?= $fetch_productos['nombre']; ?></div>
                <form action="" method="post">
                    <input type="hidden" name="p_id" value="<?= $fetch_productos['id'] ?>">
                    <input type="hidden" name="nombre" value="<?= $fetch_productos['nombre'] ?>">
                    <input type="hidden" name="precio" value="<?= $fetch_productos['precio'] ?>">
                    <input type="hidden" name="imagen" value="<?= $fetch_productos['imagen'] ?>">
                    <div class="flex-btn">
                        <input type="number" name="cantidad" class="cantidad" min="1" max="99" 
                            onkeypress="if(this.value.length == 2) return false;" value="1">
                        <input type="submit" class="btn" name="agre_carrito" value="Agregar">
                    </div>
                    
                </form>
            </div>

            <?php
                    }
                }else{
                    echo '<p class="vacio">No Hay Productos Agregados!</p>';
                }
            ?>
            
            </div>

    </section>


    <?php include './front_footer.php' ?>

    
    <script src="./js/index.js"></script>
</body>

</html>