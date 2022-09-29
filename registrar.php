<?php

include './BD/conexion.php';

session_start();

if(isset($_SESSION['usuario_id'])){
    $usuario_id = $_SESSION['usuario_id'];
}else{
    $usuario_id = '';
};

if(isset($_POST['register'])){

    $nombre = $_POST['nombre'];
    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

    $apell = $_POST['apellido'];
    $apell = filter_var($apell, FILTER_SANITIZE_STRING);

    $correo = $_POST['correo'];
    $correo = filter_var($correo, FILTER_SANITIZE_STRING);

    $contra = sha1($_POST['contra']);
    $contra = filter_var($contra, FILTER_SANITIZE_STRING);

    $conf_contra = sha1($_POST['conf_contra'] );
    $conf_contra = filter_var($conf_contra, FILTER_SANITIZE_STRING);

    $celu = $_POST['celular'];
    $celu = filter_var($celu, FILTER_SANITIZE_STRING);

    $celu = $_POST['celular'];
    $celu = filter_var($celu, FILTER_SANITIZE_STRING);

 
    $select_usuario = $conn->prepare("SELECT * FROM `usuario` WHERE nombre = ? AND correo = ?");
    $select_usuario->execute([$nombre, $correo]);
 
    if($select_usuario->rowCount() > 0){
       $mensaje[] = 'Este correo electronico ya existe!';
    }else{
       if($contra != $conf_contra){
          $mensaje[] = 'Las contraseñas no son iguales!';
       }else{
          $insert_usuario= $conn->prepare("INSERT INTO `usuario`(nombre, apellido, correo, celular, contraseña) VALUES(?,?,?,?,?)");
          $insert_usuario->execute([$nombre, $apell, $correo, $celu, $conf_contra]);
          header('location:./login.php');
       }
    }
 
}

?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">


    <!-- LINK CSS -->
    <script src="https://kit.fontawesome.com/5cbce06bb4.js" crossorigin="anonymous"></script>


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

    <div class="flex">

        <form class="formulario" action="" method="post">
            
            <h1>REGISTRATE</h1>
            
            <div class="container">
            
                <div class="input-container">
                    <i class="fas fa-user icon"></i>
                    <input name="nombre" type="text" placeholder="Nombre Completo" oninput="this.value = this.value.replace(/\s/g, '')" required class="input_tex">
                </div>
                <div class="input-container">
                    <i class="fas fa-user icon"></i>
                    <input name="apellido" type="text" placeholder="Apellido Completo" required class="input_tex">
                </div>
                    
                <div class="input-container">
                    <i class="fas fa-envelope icon"></i>
                    <input name="correo" type="text" placeholder="Correo Electronico" required class="input_tex">
                </div>
                    
                <div class="input-container">
                    <i class="fas fa-key icon"></i>
                    <input name="contra" type="password" placeholder="Contraseña" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')" required class="input_tex">
                </div>

                <div class="input-container">
                    <i class="fas fa-key icon"></i>
                    <input name="conf_contra" type="password" placeholder="Confirmar Contraseña" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')" required class="input_tex">
                </div>

                <div class="input-container">
                    <i class="fa-solid fa-phone icon"></i>
                    <input name="celular" type="text" placeholder="Numero de celular" required class="input_tex">
                </div>

                <div class="flex-btn">
                    <input type="submit" value="Registrar" class="btn" name="register">
                    <a href="./index.php" class="btn-salir">Cancelar</a>
                </div>

                    <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                    <p>¿Ya tienes una cuenta? <a class="link" href="./login.php">Iniciar Sesion</a></p>
            </div>
        </form>
    </div>
</body>
</html>