<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?? '' ?></title>
</head>
<body>
  <main style="background-color: red;">
    <p>Esto es un ejemplo de lo que va en el email</p>
    <h1><?php echo $this->name . ' ' . $this->lastname ?></h1>

    <h1><?php echo $this->email ?></h1>

    <p>este es el nombre de la compañia: <?php echo $company ?></p>

    <a href="<?php echo $href . $this->token ?>" >
      <span style="background-color: green; color: white;"><?php echo $buttonName ?></span>
    </a>
  </main>
</body>
</html>