<?php

include '../BD/conexion.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

if(isset($_POST['modif_produc'])){

   $prod_id = $_POST['prod_id'];
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $precio = $_POST['precio'];
   $precio = filter_var($precio, FILTER_SANITIZE_STRING);

   $imagen_actual = $_POST['imagen_actual'];
   $img_nueva = $_FILES['img_nueva']['name'];
   $img_nueva = filter_var($img_nueva, FILTER_SANITIZE_STRING);
   $img_size = $_FILES['img_nueva']['size'];
   $img_tmp_name = $_FILES['img_nueva']['tmp_name'];
   $img_folder = '../img_productos/'.$img_nueva;

   $modif_produc = $conn->prepare("UPDATE `productos` SET nombre = ?, precio = ? WHERE id = ?");
   $modif_produc->execute([$nombre, $precio, $prod_id]);

   $mensaje[] = 'Producto Modificado Exitosamente!!!';

   if(!empty($img_nueva)){
      if($img_size > 2000000){
         $mensaje[] = 'El tamaño de la imagen en muy largo!';
      }else{
         $update_img = $conn->prepare("UPDATE `productos` SET imagen = ? WHERE id = ?");
         $update_img->execute([$img_nueva, $prod_id]);
         move_uploaded_file($img_tmp_name, $img_folder);
         unlink('../img_productos/'.$imagen_actual);
         header('location:./admin_productos.php');
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
   <title>Modificar Producto</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="modif_productos">

      <h1 class="titulo">Modificar Producto</h1>

      <?php
         $modif_id = $_GET['update'];
         $select_productos = $conn->prepare("SELECT * FROM `productos` WHERE id = ?");
         $select_productos->execute([$modif_id]);
         if($select_productos->rowCount() > 0){
            while($fetch_productos = $select_productos->fetch(PDO::FETCH_ASSOC)){ 
      ?>
      <form action="" enctype="multipart/form-data" method="post">
         <input type="hidden" name="prod_id" value="<?= $fetch_productos['id']; ?>">
         <input type="hidden" name="imagen_actual" value="<?= $fetch_productos['imagen']; ?>">
         <img src="../img_productos/<?= $fetch_productos['imagen']; ?>" alt="">
         <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="nombre" 
            value="<?= $fetch_productos['nombre']; ?>">
         <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" 
            onkeypress="if(this.value.length == 10) return false;" name="precio" value="<?= $fetch_productos['precio']; ?>">
         <input type="file" name="img_nueva" accept="img_nueva/jpg, img_nueva/jpeg, img_nueva/png" class="box">
         <div class="flex-btn">
            <input type="submit" value="Modificar" class="btn" name="modif_produc">
            <a href="./admin_productos.php" class="btn-actualizar">Cancelar</a>
         </div>
      </form>

      <?php
            }
         }else{
            echo '<p class="vacio">no product found!</p>';
         }
      ?>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>