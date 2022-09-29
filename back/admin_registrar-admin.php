<?php

include '../BD/conexion.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

if(isset($_POST['Registrar'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $apellido = $_POST['apellido'];
   $apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
   $celular = $_POST['celular'];
   $celular = filter_var($celular, FILTER_SANITIZE_STRING);

   $usuario = $_POST['usuario'];
   $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
   $contraseña = sha1($_POST['contraseña']);
   $contraseña = filter_var($contraseña, FILTER_SANITIZE_STRING);
   $conf_contraseña = sha1($_POST['conf_contraseña']);
   $conf_contraseña = filter_var($conf_contraseña, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE usuario = ?");
   $select_admin->execute([$usuario]);

   if($select_admin->rowCount() > 0){
      $mensaje[] = 'Este usuario ya existe!';
   }else{
      if($contraseña != $conf_contraseña){
         $mensaje[] = 'Ingresa tus contraseñas correctamente!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(usuario, contraseña, nombre, apellido, celular) VALUES(?,?,?,?,?)");
         $insert_admin->execute([$usuario, $conf_contraseña, $nombre, $apellido, $celular]);
         $mensaje[] = 'Nuevo administrador Registrado!!!';
         header('location:./admin_admins.php');
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
   <title>Registro de Administrador</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="regis_admin">

      <form action="" method="post">
         <h3 class="titulo">Registrar Administrador</h3>
         <input type="text" id="nombre" class="box" name="nombre" placeholder="Escribe tu nombre" required maxlength="50" title="Ingrese su Nombre">
         <input type="text" id="apellido" class="box" name="apellido" placeholder="Escribe tu apellido" required maxlength="50" title="Ingrese su Apellido">
         <input type="text" name="usuario" required placeholder="Escribe tu usuario" maxlength="20"  
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="contraseña" required placeholder="Nueva contraseña" maxlength="20"  
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="conf_contraseña" required placeholder="Confirmar contraseña" maxlength="20"  
            class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="text" id="cel" class="box" name="celular" placeholder="Ingresa tu celular" required maxlength="50" title="Ingrese su número de celular">
         <div class="flex-btn">
            <input type="submit" value="registrar" class="btn" name="Registrar">
            <a href="./admin_admins.php" class="btn-salir">Cancelar</a>
      </form>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>