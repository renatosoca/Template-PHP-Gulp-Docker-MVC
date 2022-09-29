<?php

    if(isset($_SESSION['usuario_id'])){
        $usuario_id = $_SESSION['usuario_id'];
    }else{
        $usuario_id = '';
    };

    if(isset($_GET['delete_item'])){
        $borrar_carrito_id = $_GET['delete_item'];
        $delete_carrito = $conn->prepare("DELETE FROM `carrito` WHERE id = ?");
        $delete_carrito->execute([$borrar_carrito_id]);
    };

    if(isset($_POST['actualizar_cant'])){
        $carrito_id = $_POST['carrito_id'];
        $cantidad = $_POST['cantidad'];
        $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);

        $update_cantidad = $conn->prepare("UPDATE `carrito` SET cantidad = ? WHERE id = ?");
        $update_cantidad->execute([$cantidad, $carrito_id]);
    };

    if(isset($_GET['cerrar_sesion'])){
        session_unset();
        session_destroy();
        header('location:./index.php');
    };
?>

<?php
    if(isset($mensaje)){
        foreach($mensaje as $mensaje){
            echo '
            <div class="mensaje">
                <span>'.$mensaje.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
?>


<!-- INICIO HEADER -->
<header class="header">

    <div class="container">

        <a href="./index.php" class="logo">
                <img src="./img/Logo-Trans.png" alt="Logo-Empresa">
        </a>

        <nav>
            <a href="./index.php">INICIO</a>
            <a href="./productos.php">PRODUCTOS</a>
            <a href="./contactanos.php">CONTÁCTANOS</a>
            <a href="./servicios.php">SERVICIOS</a>
            <a href="./equipo.php">NUESTRO EQUIPO</a>
        </nav>

        <div class="iconos">
            <i id="btn-usuario" class="fa-solid fa-user"></i>

            <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `carrito` WHERE usuario_id = ?");
                $count_cart_items->execute([$usuario_id]);
                $total_cart_items = $count_cart_items->rowCount();
            ?>

            <i id="btn-carrito" class="fa-solid fa-cart-shopping">(<span><?=$total_cart_items ?></span>)</i>
            <i id="btn-menu" class="fa-solid fa-bars"></i>

        </div>

        <div class="profile">
            <?php
                $select_usuario = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
                $select_usuario->execute([$usuario_id]);
                if($select_usuario->rowCount() > 0){
                while($fetch_usuario = $select_usuario->fetch(PDO::FETCH_ASSOC)){
                    echo '<p>Bienvenido <span>'.$fetch_usuario['nombre'].' '.$fetch_usuario['apellido'].'</span></p>';
                    echo '<a href="./upd_perfil.php" class="btn-actualizar">Editar Perfil</a>';
                    echo '<a href="./index.php?cerrar_sesion" class="btn-salir">Cerrar Sesión</a>';

                }
                }else{
                echo '<p>Por favor, inicia Sesion!</p>';
                echo '<a href="./login.php" class="btn">Iniciar Sesión</a>';
                echo '<a href="./registrar.php" class="btn">Registrarte</a>';
                }
            ?>
        </div>

    </div>

</header>
<!-- FIN HEADER -->


<!-- INICIO CARRITO -->
<div class="carrito">

    <section>

        <div id="cerrar_carrito"><span>Cerrar</span></div>

        <?php
            $gran_total = 0;
            $select_carrito = $conn->prepare("SELECT * FROM `carrito` WHERE usuario_id = ?");
            $select_carrito->execute([$usuario_id]);
            if($select_carrito->rowCount() > 0){
                while($fetch_carrito = $select_carrito->fetch(PDO::FETCH_ASSOC)){
                $sub_total = ($fetch_carrito['precio'] * $fetch_carrito['cantidad']);
                $gran_total += $sub_total; 
        ?>

        <div class="box">
            <a href="?delete_item=<?= $fetch_carrito['id']; ?>" class="fas fa-times" onclick="return confirm('borrar este producto?');"></a>
            <img src="./img_productos/<?=$fetch_carrito['imagen'];?>" alt="">
            <div class="content">
                <p><?=$fetch_carrito['nombre'].' ';?><span>S/<?=$fetch_carrito['precio'];?></span></p>
                <form action="" method="post">
                    <input type="hidden" name="carrito_id" value="<?= $fetch_carrito['id']; ?>">
                    <input type="number" name="cantidad" class="cantidad" min="1" max="99" value="<?= $fetch_carrito['cantidad']; ?>"
                     onkeypress="if(this.value.length == 2) return false;">
                    <button type="submit" class="fas fa-edit" name="actualizar_cant"></button>
                </form>
            </div>
        </div>
        
        <?php
                }
            }else{
            echo '<p class="titulo"><span>Tu carrito está vacio!!</span></p>';
            echo '<p class="titulo"><span>Por favor, compre un producto :)!</span></p>';
            echo '
                    <div class="ImgCarrito">
                        <img src="./img/CarritoVacio(250 × 250 px).png">
                    </div>';
            }
        ?>

        <?php
            if($select_carrito->rowCount() > 0){
                echo '<a href="./compra.php" class="btn-actualizar">Ordenar Ahora</a>';
            }
        ?>

    </section>

</div>
<!-- FIN CARRITO -->

