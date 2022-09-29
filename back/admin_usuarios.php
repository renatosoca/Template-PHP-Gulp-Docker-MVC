<?php

include '../BD/conexion.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:./login.php');
};

if(isset($_GET['delete'])){
   $borrar_id = $_GET['delete'];
   $borrar_usuario = $conn->prepare("DELETE FROM `usuario` WHERE id = ?");
   $borrar_usuario->execute([$borrar_id]);
   header('location:./admin_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cuentas de Usuarios</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="cuenta_usuarios">

      <h1 class="titulo">Cuentas de Usuarios</h1>

      <div class="container">

         <?php
            $select_usuario = $conn->prepare("SELECT * FROM `usuario`");
            $select_usuario->execute();
            if($select_usuario->rowCount() > 0){
               while($fetch_usuario = $select_usuario->fetch(PDO::FETCH_ASSOC)){   
         ?>

         <div class="box">
            <p> Usuario ID : <span><?= $fetch_usuario['id']; ?></span> </p>
            <p> Nombre : <span><?= $fetch_usuario['nombre']; ?></span> </p>
            <p> Apellido : <span><?= $fetch_usuario['apellido']; ?></span> </p>
            <p> Correo : <span><?= $fetch_usuario['correo']; ?></span> </p>
            <p> Celular : <span><?= $fetch_usuario['celular']; ?></span> </p>
            <a href="./admin_usuarios.php?delete=<?= $fetch_usuario['id']; ?>" onclick="return confirm('Eliminar esta cuenta?')" 
               class="btn-salir">Eliminar</a>
         </div>

         <?php
               }
            }else{
               echo '<p class="vacio">No hay Usuarios Registrados!!!</p>';
            }
         ?>

      </div>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>