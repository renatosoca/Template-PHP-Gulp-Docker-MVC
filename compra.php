<?php

include './BD/conexion.php';

   session_start();

   if(isset($_SESSION['usuario_id'])){
      $usuario_id = $_SESSION['usuario_id'];
   }else{
      $usuario_id = '';
      header('location:./index.php');
   };

   if(isset($_POST['comprar'])){

      $nombre = $_POST['nombre'];
      $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
      $celular = $_POST['celular'];
      $celular = filter_var($celular, FILTER_SANITIZE_STRING);
      $correo = $_POST['correo'];
      $correo = filter_var($correo, FILTER_SANITIZE_STRING);
      $metodo = $_POST['metodo'];
      $metodo = filter_var($metodo, FILTER_SANITIZE_STRING);
      $direccion = $_POST['direccion'];
      $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
      $total_productos = $_POST['total_productos'];
      $total_precio = $_POST['total_precio'];

      $check_carrito = $conn->prepare("SELECT * FROM `carrito` WHERE usuario_id = ?");
      $check_carrito->execute([$usuario_id]);

      if($check_carrito->rowCount() > 0){

         if($direccion == ''){
            $mensaje[] = 'Por favor ingresa tu dirección!';
         }else{
            
            $insert_orden = $conn->prepare("INSERT INTO `ordenes`(usuario_id, nombre, celular, metodo, correo, direccion, total_productos, total_precios) VALUES(?,?,?,?,?,?,?,?)");
            $insert_orden->execute([$usuario_id, $nombre, $celular, $metodo, $correo, $direccion, $total_productos, $total_precio]);

            $delete_carrito = $conn->prepare("DELETE FROM `carrito` WHERE usuario_id = ?");
            $delete_carrito->execute([$usuario_id]);

            header('location:./index.php');
         }
         
      }else{
         $mensaje[] = 'Tu carrito está vacio!';
      }

   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Realizar Compra</title>

   <!-- LINK CSS -->
   <link rel="stylesheet" href="./css/usuario_style.css">

   <!-- ICONOS -->
   <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>


   <link rel="icon" href="./img/logo_icons.png">

   <!-- CHAT BOT -->
   <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>
</head>

<body>

   <!-- header section starts  -->
   <?php include 'front_header.php'; ?>
   <!-- header section ends -->

   <section class="verificar">

   <h1 class="titulo">Resumen de la Compra</h1>

   <form action="" method="post">

      <div class="box-productos">
         <h3>Tus Productos</h3>
         <?php
            $grand_total = 0;
            $array_productos[] = '';
            $select_carrito = $conn->prepare("SELECT * FROM `carrito` WHERE usuario_id = ?");
            $select_carrito->execute([$usuario_id]);
            if($select_carrito->rowCount() > 0){
               while($fetch_carrito = $select_carrito->fetch(PDO::FETCH_ASSOC)){
                  $array_productos[] = $fetch_carrito['nombre'].' ('.$fetch_carrito['precio'].' x '. $fetch_carrito['cantidad'].') - ';
                  $total_productos = implode($array_productos);
                  $grand_total += ($fetch_carrito['precio'] * $fetch_carrito['cantidad']);
         ?>
         <p><span class="nombre"><?= $fetch_carrito['nombre']; ?></span><span class="precio">S/. <?= $fetch_carrito['precio']; ?> x <?= $fetch_carrito['cantidad']; ?></span></p>
         <?php
               }
            }else{
               echo '<p class="vacio">Tu Carrito esta vacio!</p>';
            }
         ?>
         <p class="grand-total"><span class="nombre">Total :</span><span class="precio">S/. <?= $grand_total; ?></span></p>
      </div>

      <?php
         $seleccionar_perfil = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
         $seleccionar_perfil->execute([$usuario_id]);
         $fetch_usuario = $seleccionar_perfil->fetch(PDO::FETCH_ASSOC);
      ?>

      <input type="hidden" name="total_productos" value="<?= $total_productos; ?>">
      <input type="hidden" name="total_precio" value="<?= $grand_total; ?>" value="">
      <input type="hidden" name="nombre" value="<?= $fetch_usuario['nombre'].' '.$fetch_usuario['apellido'] ?>">
      <input type="hidden" name="celular" value="<?= $fetch_usuario['celular'] ?>">
      <input type="hidden" name="correo" value="<?= $fetch_usuario['correo'] ?>">
      <input type="hidden" name="direccion" value="<?= $fetch_usuario['direccion'] ?>">

      <div class="info-usuario">
         <h3>Tu información</h3>
         <p><i class="fas fa-user"></i><span><?= $fetch_usuario['nombre'].' '.$fetch_usuario['apellido'] ?></span></p>
         <p><i class="fas fa-phone"></i><span><?= $fetch_usuario['celular'] ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $fetch_usuario['correo'] ?></span></p>
         <a href="./upd_perfil.php" class="btn">Actualizar Información</a>

         <h3>Dirección Para Delivery</h3>

         <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_usuario['direccion'] == ''){echo 'Por favor, ingrese su dirección';}else{echo $fetch_usuario['direccion'];} ?></span></p>
         <a href="./upd_direccion.php" class="btn">Cambiar Dirección</a>
         <select name="metodo" class="box" required>
            <option value="" disabled selected>-- Selecciona el metodo de pago --</option>
            <option value="Pago en Efectivo">Pago en Efectivo</option>
            <option value="Tarjeta de Crédito">Tarjeta de Credito</option>
            <option value="Paypal">Paypal</option>
         </select>
         <input type="submit" value="Comprar Ahora" class="btn <?php if($fetch_usuario['direccion'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--rojo); color:var(--blanco);" name="comprar">
      </div>

   </form>
      
   </section>

   <!-- footer section starts  -->
   <?php include 'front_footer.php'; ?>
   <!-- footer section ends -->

   <!-- custom js file link  -->
   <script src="./js/index.js"></script>

</body>
</html>