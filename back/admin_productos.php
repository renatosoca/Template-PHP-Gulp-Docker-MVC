<?php

include '../BD/conexion.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:./login.php');
   };

   if(isset($_POST['agreg_producto'])){

      $nombre = $_POST['nombre'];
      $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
      $precio = $_POST['precio'];
      $precio = filter_var($precio, FILTER_SANITIZE_STRING);

      $img = $_FILES['img']['name'];
      $img = filter_var($img, FILTER_SANITIZE_STRING);
      $img_size = $_FILES['img']['size'];
      $img_tmp_nombre = $_FILES['img']['tmp_name'];
      $img_folder = '../img_productos/'.$img;

      $select_product = $conn->prepare("SELECT * FROM `productos` WHERE nombre = ?");
      $select_product->execute([$nombre]);

      if($select_product->rowCount() > 0){
         $mensaje[] = 'El Nombre del Producto ya Existe!!!';
      }else{
         if($img_size > 2000000){
            $mensaje[] = 'El tamaño de la imagen es muy grande!!!';
         }else{
            $insert_product = $conn->prepare("INSERT INTO `productos`(nombre, precio, imagen) VALUES(?,?,?)");
            $insert_product->execute([$nombre, $precio, $img]);
            move_uploaded_file($img_tmp_nombre, $img_folder);
            $mensaje[] = 'Nuevo Producto Agredado!!!';
         }
      }

   }

   if(isset($_GET['delete'])){
      $borrar_id = $_GET['delete'];
      $borrar_productos_img = $conn->prepare("SELECT imagen FROM `productos` WHERE id = ?");
      $borrar_productos_img->execute([$borrar_id]);
      $fetch_borrar_img = $borrar_productos_img->fetch(PDO::FETCH_ASSOC);
      unlink('../img_productos/'.$fetch_borrar_img['imagen']);
      $borrar_productos = $conn->prepare("DELETE FROM `productos` WHERE id = ?");
      $borrar_productos->execute([$borrar_id]);
      $borrar_cart = $conn->prepare("DELETE FROM `carrito` WHERE pid = ?");
      $borrar_cart->execute([$borrar_id]);
      header('location:./admin_productos.php');
   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Productos</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="agre_productos">

      <h1 class="titulo">Agregar Nuevo Producto</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <input type="text" class="box" required maxlength="100" placeholder="Ingresa el nombre del producto" name="nombre">
         <input type="number" min="1" class="box" required max="9999999999" placeholder="Ingresa el precio del producto" onkeypress="if(this.value.length == 10) return false;" name="precio">
         <input type="file" name="img" accept="img/jpg, img/jpeg, img/png" class="box" required>
         <input type="submit" value="agregar producto" class="btn" name="agreg_producto">
      </form>

   </section>

   <section class="mostrar_productos">

      <h1 class="titulo">Productos Agregados</h1>

      <div class="container">

      <?php
         $select_productos = $conn->prepare("SELECT * FROM `productos`");
         $select_productos->execute();
         if($select_productos->rowCount() > 0){
            while($fetch_productos = $select_productos->fetch(PDO::FETCH_ASSOC)){ 
      ?>

      <div class="box">
         <div class="precio">S/. <?= $fetch_productos['precio']; ?></div>
         <img src="../img_productos/<?= $fetch_productos['imagen']; ?>" alt="imagen producto <?= $fetch_productos['nombre']; ?>">
         <div class="nombre"><?= $fetch_productos['nombre']; ?></div>
         <div class="flex-btn">
            <a href="./admin_productos.php?delete=<?= $fetch_productos['id']; ?>" class="btn-salir" onclick="return confirm('Borrar el producto?');">Borrar</a>
            <a href="./admin_editar-prod.php?update=<?= $fetch_productos['id']; ?>" class="btn-actualizar">Editar</a>
         </div>
      </div>

      <?php
            }
         }else{
            echo '<p class="vacio">No Hay Productos Agregados!</p>';
         }
      ?>
      
      </div>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>