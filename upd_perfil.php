<?php

include './BD/conexion.php';

   session_start();

   if(isset($_SESSION['usuario_id'])){
      $usuario_id = $_SESSION['usuario_id'];
   }else{
      $usuario_id = '';
      header('location:index.php');
   };

   if(isset($_POST['enviar'])){

      $nombre = $_POST['nombre'];
      $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
      $correo = $_POST['correo'];
      $correo = filter_var($correo, FILTER_SANITIZE_STRING);
      $celular = $_POST['celular'];
      $celular = filter_var($celular, FILTER_SANITIZE_STRING);

      if(!empty($nombre)){
         $update_nombre = $conn->prepare("UPDATE `usuario` SET nombre = ? WHERE id = ?");
         $update_nombre->execute([$nombre, $usuario_id]);
      }

      if(!empty($correo)){
         $select_correo = $conn->prepare("SELECT * FROM `usuario` WHERE correo = ?");
         $select_correo->execute([$correo]);
         if($select_correo->rowCount() > 0){

         }else{
            $update_correo = $conn->prepare("UPDATE `usuario` SET correo = ? WHERE id = ?");
            $update_correo->execute([$correo, $usuario_id]);
         }
      }

      if(!empty($celular)){
         $select_celular = $conn->prepare("SELECT * FROM `usuario` WHERE celular = ?");
         $select_celular->execute([$celular]);
         if($select_celular->rowCount() > 0){
            $message[] = 'number already taken!';
         }else{
            $update_celular = $conn->prepare("UPDATE `usuario` SET celular = ? WHERE id = ?");
            $update_celular->execute([$celular, $usuario_id]);
         }
      }
      
      $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
      $select_contra = $conn->prepare("SELECT contraseña FROM `usuario` WHERE id = ?");
      $select_contra->execute([$usuario_id]);
      $fetch_contra = $select_contra->fetch(PDO::FETCH_ASSOC);
      $contra_actu = $fetch_contra['contraseña'];
      $contra_ante = sha1($_POST['contra_ante']);
      $contra_ante = filter_var($contra_ante, FILTER_SANITIZE_STRING);
      $contra_nueva = sha1($_POST['contra_nueva']);
      $contra_nueva = filter_var($contra_nueva, FILTER_SANITIZE_STRING);
      $confir_contra = sha1($_POST['confir_contra']);
      $confir_contra = filter_var($confir_contra, FILTER_SANITIZE_STRING);

      if($contra_ante != $empty_pass){
         if($contra_ante != $contra_actu){
            $mensaje[] = 'old password not matched!';
         }elseif($contra_nueva != $confir_contra){
            $mensaje[] = 'confirm password not matched!';
         }else{
            if($contra_nueva != $empty_pass){
               $update_contraseña = $conn->prepare("UPDATE `usuario` SET contraseña = ? WHERE id = ?");
               $update_contraseña->execute([$confir_contra, $usuario_id]);
               $mensaje[] = 'password updated successfully!';
            }else{
               $mensaje[] = 'please enter a new password!';
            }
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
   <title>Actualizar Perfil</title>

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
   <?php include './front_header.php'; ?>
   <!-- header section ends -->

   <section class="form-container update-form">

      <form action="" method="post">
         <h3>Actualizar Perfil</h3>
         <?php
            $seleccionar_perfil = $conn->prepare("SELECT * FROM `usuario` WHERE id = ?");
            $seleccionar_perfil->execute([$usuario_id]);
            $fetch_usuario = $seleccionar_perfil->fetch(PDO::FETCH_ASSOC);
         ?>
         <input type="text" name="nombre" placeholder="<?= $fetch_usuario['nombre']; ?>" class="box" maxlength="50">
         <input type="email" name="correo" placeholder="<?= $fetch_usuario['correo']; ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="number" name="celular" placeholder="<?= $fetch_usuario['celular']; ?>"" class="box" min="0" max="9999999999" maxlength="10">
         <input type="password" name="contra_ante" placeholder="Antigua contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="contra_nueva" placeholder="Nueva contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="confir_contra" placeholder="confirmar contraseña" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <div class="flex-btn">
            <input type="submit" value="Actualizar Ahora" name="enviar" class="btn">
            <a href="./compra.php" class="btn-salir">Cancelar</a>
         </div>
      </form>

   </section>

   <?php include './front_footer.php'; ?>

   <!-- custom js file link  -->
   <script src="./js/index.js"></script>

</body>
</html>