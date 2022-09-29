<?php

include './BD/conexion.php';

   session_start();

   if(isset($_SESSION['usuario_id'])){
      $usuario_id = $_SESSION['usuario_id'];
   }else{
      $usuario_id = '';
      header('location:1index.php');
   };

   if(isset($_POST['enviar'])){

      $direccion = $_POST['ciudad'].', '.$_POST['depar'].', '.$_POST['provin'].', '.$_POST['calle'] .', '. $_POST['direc'];
      $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);

      $update_direccion = $conn->prepare("UPDATE `usuario` set direccion = ? WHERE id = ?");
      $update_direccion->execute([$direccion, $usuario_id]);
      header('location:compra.php');

   }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cambiar Dirección</title>

   <!-- LINK CSS -->
   <link rel="stylesheet" href="./css/usuario_style.css">

   <!-- ICONOS -->
   <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>


   <link rel="icon" href="./img/logo_icons.png">

   <!-- CHAT BOT -->
   <script src="//code.tidio.co/ogce8h2dvsk1vscoc7nxv8ebnff7wxtz.js" async></script>

</head>

<body>
      
   <?php include './front_header.php' ?>

   <section class="form-container">

      <form action="" method="post">
         <h3>Actualizar Dirección</h3>
         
         <input type="text" class="box" placeholder="Ciudad" required maxlength="50" name="ciudad">
         <input type="text" class="box" placeholder="Departamento" required maxlength="50" name="depar">
         <input type="text" class="box" placeholder="Provincia" required maxlength="50" name="provin">
         <input type="text" class="box" placeholder="Calle" required maxlength="50" name="calle">
         <input type="text" class="box" placeholder="Dirección" required maxlength="100" name="direc">
         <div class="flex-btn">
            <input type="submit" value="Guardar Dirección" name="enviar" class="btn">
            <a href="./compra.php" class="btn-salir">Cancelar</a>
         </div>
      </form>

   </section>

   <?php include './front_footer.php' ?>

   <!-- custom js file link  -->
   <script src="./js/index.js"></script>

</body>
</html>