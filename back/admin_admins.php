<?php

include '../BD/conexion.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:./login.php');
   }

   if(isset($_GET['borrar'])){
      $borrar_id = $_GET['borrar'];
      $borrar_orden = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
      $borrar_orden->execute([$borrar_id]);
      header('location:../back/admin_admins.php');
   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cuentas de Administradores</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="cuentas-admin">

      <h1 class="titulo">administradores</h1>
      
      <div class="box-registro">
         <p>Agregar nuevo administrador</p>
         <a href="./admin_registrar-admin.php" class="btn">registrar administrador</a>
      </div>

      <div class="container">

         <?php
            $select_admin = $conn->prepare("SELECT * FROM `admin`");
            $select_admin->execute();
            if($select_admin->rowCount() > 0){
               while($fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC)){   
         ?>

         <div class="box">
            <p> ID Admin : <span><?= $fetch_admin['id']; ?></span> </p>
            <p> Usuario : <span><?= $fetch_admin['usuario']; ?></span> </p>
            <p> Nombre : <span><?= $fetch_admin['nombre']; ?></span> </p>
            <p> Apellido : <span><?= $fetch_admin['apellido']; ?></span> </p>
            <p> Celular : <span><?= $fetch_admin['celular']; ?></span> </p>
            <div class="flex-btn">
               <a href="./admin_admins.php?borrar=<?= $fetch_admin['id']; ?>" onclick="return confirm('Borrar cuenta de Administrador?')" class="btn-salir">Eliminar</a>
               <a href="./admin_editar-perfil.php" class="btn-actualizar">Modificar</a>
            </div>
         </div>
         <?php
               }
            }else{
               echo '<p class="vacio">No hay Cuentas de Administrador Disponible!</p>';
            }
         ?>

      </div>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>