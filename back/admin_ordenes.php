<?php

include '../BD/conexion.php';

   session_start();

   $admin_id = $_SESSION['admin_id'];

   if(!isset($admin_id)){
      header('location:./login.php');
   }

   if(isset($_POST['actu_pago'])){

      $orden_id = $_POST['orden_id'];
      $estado_compra = $_POST['estado_compra'];
      $estado_compra = filter_var($estado_compra, FILTER_SANITIZE_STRING);
      $actu_pago = $conn->prepare("UPDATE `ordenes` SET estado_compra = ? WHERE id = ?");
      $actu_pago->execute([$estado_compra, $orden_id]);
      $mensaje[] = 'Estado de Compra Actualizado!!!';
   }

   if(isset($_GET['borrar'])){
      $borrar_id = $_GET['borrar'];
      $borrar_orden = $conn->prepare("DELETE FROM `ordenes` WHERE id = ?");
      $borrar_orden->execute([$borrar_id]);
      header('location:./admin_ordenes.php');
   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pedidos</title>

   <!-- LINK FONT AWESOME  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- LINK ESTILOS CSS  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="../img/logo_icons.png">

</head>
<body>

   <?php include './admin_header.php' ?>

   <section class="ordenes">

      <h1 class="titulo">Ordenes Realizadas</h1>

      <div class="container">

         <?php
            $select_ordenes = $conn->prepare("SELECT * FROM `ordenes`");
            $select_ordenes->execute();
            if($select_ordenes->rowCount() > 0){
               while($fetch_ordenes = $select_ordenes->fetch(PDO::FETCH_ASSOC)){
         ?>

         <div class="box">
            <p> Fecha de Compra : <span><?= $fetch_ordenes['fec_compra']; ?></span> </p>
            <p> Nombre : <span><?= $fetch_ordenes['nombre']; ?></span> </p>
            <p> Celular : <span><?= $fetch_ordenes['celular']; ?></span> </p>
            <p> Dirección : <span><?= $fetch_ordenes['direccion']; ?></span> </p>
            <p> Productos Totales : <span><?= $fetch_ordenes['total_productos']; ?></span> </p>
            <p> Precio Total : <span><?= $fetch_ordenes['total_precios']; ?></span> </p>
            <p> Metodo de Pago : <span><?= $fetch_ordenes['metodo']; ?></span> </p>
            <form action="" method="post">
               <input type="hidden" name="orden_id" value="<?= $fetch_ordenes['id']; ?>">
               <select name="estado_compra" class="select">
                  <option selected disabled><?= $fetch_ordenes['estado_compra']; ?></option>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Cancelado">Cancelado</option>
               </select>
               <div class="flex-btn">
                  <input type="submit" value="Actualizar" class="btn-actualizar" name="actu_pago">
                  <a href="./admin_ordenes.php?borrar=<?= $fetch_ordenes['id']; ?>" class="btn-salir" onclick="return confirm('Borrar esta Orden?');">borrar</a>
               </div>
            </form>
         </div>

         <?php
               }
            }else{
               echo '<p class="vacio">Sin Pedidos</p>';
            }
         ?>

      </div>

   </section>

   <?php include './admin_footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>
</html>