<!-- HEADER -->

<?php
   if(isset($mensaje)){
      foreach($mensaje as $mensaje){
         echo '
         <div class="mensaje">
            <span>'.$mensaje.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="container">
        <a href="./admin_index.php" class="logo">
                <img src="../img/Logo-Trans.png" alt="">
            </a>

        <nav>
            <a href="./admin_index.php">Inicio</a>
            <a href="./admin_productos.php">Productos</a>
            <a href="./admin_ordenes.php">Ordenes</a>
            <a href="./admin_usuarios.php">Usuarios</a>
            <a href="./admin_admins.php">Admins</a>
        </nav>

        <div class="iconos">
            <div id="btn-usuario" class="fas fa-user"></div>
            <div id="btn-menu" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <?php
                $seleccionar_perfil = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
                $seleccionar_perfil->execute([$admin_id]);
                $mostrar_perfil = $seleccionar_perfil->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>Usuario:<span> <?= $mostrar_perfil['usuario']; ?></span></p>
            <p>Nombre :<span> <?= $mostrar_perfil['nombre'].' '.$mostrar_perfil['apellido'] ?></span></p>
            <a href="./admin_editar-perfil.php" class="btn">Editar Perfil</a>
            <a href="./cerrar_sesion.php" class="btn-salir">Cerrar Sesión</a>
        </div>
   </section>

</header>

<!-- FIN HEADER -->