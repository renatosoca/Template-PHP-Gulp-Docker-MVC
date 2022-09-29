<?php

include './BD/conexion.php';

    session_start();

    /* Usuario */
    if(isset($_POST['login'])){

        $correo = $_POST['correo'];
        $correo = filter_var($correo, FILTER_SANITIZE_STRING);
        $contra_encrip = sha1($_POST['contra_encrip']);
        $contra_encrip = filter_var($contra_encrip, FILTER_SANITIZE_STRING);

        $select_usuario = $conn->prepare("SELECT * FROM `usuario` WHERE correo = ? AND contraseña = ?");
        $select_usuario->execute([$correo, $contra_encrip]);
        $row = $select_usuario->fetch(PDO::FETCH_ASSOC);

        if($select_usuario->rowCount() > 0){
            $_SESSION['usuario_id'] = $row['id'];
            header('location:./index.php');
        }
    }

    /* Admin */
    if(isset($_POST['login'])){

        $usuario = $_POST['correo'];
        $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
        $contraseña = sha1($_POST['contra_encrip']);
        $contraseña = filter_var($contraseña, FILTER_SANITIZE_STRING);
    
        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE usuario = ? AND contraseña = ?");
        $select_admin->execute([$usuario, $contraseña]);
        $row = $select_admin->fetch(PDO::FETCH_ASSOC);
    
        if($select_admin->rowCount() > 0){
        $_SESSION['admin_id'] = $row['id'];
        header('location:./back/admin_index.php');
        }else{
        $mensaje[] = 'Usuario o Contraseña Incorrecto!';
        }
    
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio de Sesión</title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >


	<link rel="stylesheet" href="./css/login_registro.css">

    <link rel="icon" href="./img/logo_icons.png">
	

</head>  
<body>

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

    <div class="container_login">  

        <form class="formulario_sesion" action="" method="POST">
        
            <h1 class="titulo">INICIO DE SESIÓN</h1>
            
            <div class="container">
            
            <div class="input-container">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="ejemplo@gmail.com" required name="correo">
            </div>
                
            <div class="input-container">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" required name="contra_encrip">
            </div>

            <div class="flex-btn">
                <input type="submit" value="Ingresar" class="btn" name="login">
                <a href="./index.php" class="btn-salir">Cancelar</a>
            </div>
            <p>¿No tienes una cuenta? <a class="link" href="./registrar.php">Registrate aquí</a></p>

            </div>

        </form>

    </div>  


    <script src="./js/index.js"></script>
  
</body>
</html>