<?php

include '../BD/conexion.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:./login.php');
   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   
   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php'?>

   <section class="dashboard">

      <h1 class="titulo">dashboard</h1>

      <div class="container">

         <div class="box ordenes-por-pagarrrr">
            <?php
               $contador_sin_pagar = 0;
               $select_ordenes_sin_pagar = $conn->prepare("SELECT * FROM `ordenes` WHERE estado_compra = ?");
               $select_ordenes_sin_pagar->execute(['pendiente']);
               if($select_ordenes_sin_pagar->rowCount() > 0){
                  while($mostrar_ordenes_pendientes = $select_ordenes_sin_pagar->fetch(PDO::FETCH_ASSOC)){
                     $contador_sin_pagar += $mostrar_ordenes_pendientes['total_precios'];
                  }
               }
            ?>
            <h3>S/. <?= $contador_sin_pagar; ?></h3>
            <p>Pedidos Sin Cancelar</p>
            <a href="./admin_ordenes.php" class="btn">Mirar Ordenes</a>
         </div>

         <div class="box ordenes-pagadassss">
            <?php
               $contador_pagadas = 0;
               $select_ordenes_pagadas = $conn->prepare("SELECT * FROM `ordenes` WHERE estado_compra = ?");
               $select_ordenes_pagadas->execute(['cancelado']);
               if($select_ordenes_pagadas->rowCount() > 0){
                  while($mostrar_ordenes_pagadas = $select_ordenes_pagadas->fetch(PDO::FETCH_ASSOC)){
                     $contador_pagadas += $mostrar_ordenes_pagadas['total_precios'];
                  }
               }
            ?>
            <h3>S/. <?= $contador_pagadas; ?></h3>
            <p>Pedidos Cancelados</p>
            <a href="./admin_ordenes.php" class="btn">Mirar Ordenes</a>
         </div>

         <div class="box ordenesss">
            <?php
               $select_ordenes = $conn->prepare("SELECT * FROM `ordenes`");
               $select_ordenes->execute();
               $numero_de_ordenes = $select_ordenes->rowCount()
            ?>
            <h3><?= $numero_de_ordenes; ?></h3>
            <p>Pedidos Realizados</p>
            <a href="./admin_ordenes.php" class="btn">Mirar Ordenes</a>
         </div>

         <div class="box productosss">
            <?php
               $select_productos = $conn->prepare("SELECT * FROM `productos`");
               $select_productos->execute();
               $numero_de_productos = $select_productos->rowCount()
            ?>
            <h3><?= $numero_de_productos; ?></h3>
            <p>Productos Agregados</p>
            <a href="./admin_productos.php" class="btn">Mirar Productos</a>
         </div>

         <div class="box usuariosss">
            <?php
               $select_usuarios = $conn->prepare("SELECT * FROM `usuario`");
               $select_usuarios->execute();
               $numero_de_usuarios = $select_usuarios->rowCount()
            ?>
            <h3><?= $numero_de_usuarios; ?></h3>
            <p>Usuarios Registrados</p>
            <a href="./admin_usuarios.php" class="btn">Mirar Usuarios</a>
         </div>

         <div class="box adminsss">
            <?php
               $select_admins = $conn->prepare("SELECT * FROM `admin`");
               $select_admins->execute();
               $numero_de_admins = $select_admins->rowCount()
            ?>
            <h3><?= $numero_de_admins; ?></h3>
            <p>Administradores Registrados</p>
            <a href="./admin_admins.php" class="btn">Mirar Administradores</a>
         </div>

      </div>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>