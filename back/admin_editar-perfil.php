<?php

include '../BD/conexion.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

if(isset($_POST['modificar'])){

   $usuario = $_POST['usuario'];
   $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $apellido = $_POST['apellido'];
   $apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
   $celular = $_POST['celular'];
   $celular = filter_var($celular, FILTER_SANITIZE_STRING);

   $editar_perfil_usuario = $conn->prepare("UPDATE `admin` SET usuario = ? WHERE id = ?");
   $editar_perfil_usuario->execute([$usuario, $admin_id]);

   $contra_actual = $_POST['contra_actual'];
   $conf_contra_actual = sha1($_POST['conf_contra_actual']);
   $conf_contra_actual = filter_var($conf_contra_actual, FILTER_SANITIZE_STRING);
   $nueva_contra = sha1($_POST['nueva_contra']);
   $nueva_contra = filter_var($nueva_contra, FILTER_SANITIZE_STRING);
   $conf_contra_nueva = sha1($_POST['conf_contra_nueva']);
   $conf_contra_nueva = filter_var($conf_contra_nueva, FILTER_SANITIZE_STRING);
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

   if($conf_contra_actual != $empty_pass){
      if($conf_contra_actual != $contra_actual){
         $mensaje[] = 'La contraseña ingresada es incorrecta!!!';
      }elseif($nueva_contra != $conf_contra_nueva){
         $mensaje[] = 'No coincide con tu nueva contraseña!!!';
      }else{
         if($nueva_contra != $empty_pass){
            $cambio_contra_admin = $conn->prepare("UPDATE `admin` SET usuario = ?, contraseña = ?, nombre = ?, apellido = ?, celular = ? WHERE id = ?");
            $cambio_contra_admin->execute([$usuario, $conf_contra_nueva, $nombre, $apellido, $celular, $admin_id]);
            header('location:./admin_admins.php');
            $mensaje[] = 'Modificación de Perfil Exitoso!!!';
         }else{
            $mensaje[] = 'Ingrese su nueva contraseña!!!';
         }
      }
   }else{
      $mensaje[] = 'Ingresa tu antigua contraseña!!!';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar Perfil de Administrador</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="editar_perfil_admin">

      <form action="" method="post">
         <?php
            $select_perfil_admin = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_perfil_admin->execute([$admin_id]);
            $fetch_perfil_admin = $select_perfil_admin->fetch(PDO::FETCH_ASSOC);
         ?>
         <h3 class="titulo">Perfil de Administrador</h3>
         
         <input type="hidden" name="contra_actual" value="<?= $fetch_perfil_admin['contraseña']; ?>">

         <input type="text" id="usuario" name="usuario" value="<?= $fetch_perfil_admin['usuario']; ?>" 
            required placeholder="Ingresa tu contraseña actual" maxlength="20"  class="box" 
            oninput="this.value = this.value.replace(/\s/g, '')" title="Nombre de Usuario del administrador">
         <input type="password" id="contra_actual" name="conf_contra_actual" placeholder="Contraseña Actual" 
            maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" title="Escribe tu contraseña actual">
         <input type="password" id="contra_nueva" name="nueva_contra" placeholder="Nueva Contraseña" 
            maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" title="Ingrese su nueva contraseña">
         <input type="password" id="conf_contr" name="conf_contra_nueva" placeholder="Confirmar Contraseña" 
            maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" title="ingrese nuevamente su nueva contraseña">
         <input type="text" id="nombre" class="box" name="nombre" value="<?= $fetch_perfil_admin['nombre']?>" 
            required maxlength="50" title="Ingrese su Nombre">
         <input type="text" id="apellido" class="box" name="apellido" value="<?= $fetch_perfil_admin['apellido']?>" 
            required maxlength="50" title="Ingrese su Apellido">
         <input type="number" id="cel" class="box" name="celular" value="<?= $fetch_perfil_admin['celular']?>" 
            required maxlength="50" title="Ingrese su número de celular">
         <div class="flex-btn">
            <input type="submit" value="actualizar" class="btn" name="modificar">
            <a href="./admin_admins.php" class="btn-salir">Cancelar</a>
         </div>
      </form>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>