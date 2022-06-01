<?php
    session_start();

    require 'conexion.php';
    

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT idclient, mailclient, contraclient  FROM clientes WHERE mailclient = :mailclient');
        $records->bindParam(':mailclient', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';
    
        if (count($results) > 0 && password_verify($_POST['password'], $results['contraclient'])) {
          $_SESSION['user_id'] = $results['idclient'];
          header("Location: ../index.php");
        } else {
          $message = 'Sorry, those credentials do not match';
        }
      }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../favicon.ico" style="max-width:150%;height:auto;" >
    <link rel="stylesheet" type="text/css" href="../css/nav.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/login.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?ts=<?=time()?>" />
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <title>Iniciar Sesión</title>
</head>
<body >
<header>
      <nav>
      <div id="brand">
        <div id="logo"><a href="../index.php"><img src="../imagenes/LogoNuevo.png" style="max-width:100%;height:auto;"></a></div>
        <h1 id="titulo"><img src="../imagenes/Letras2.png"  alt=""></h1>
      </div>

      <div id="menu">
        <ul id="navul">
          <span class="material-symbols-outlined" id="menu_icon">menu</span>

          <li id="menuli"><a href="../paginas/blog.php">Sobre Nosotros</a></li>
          <li id="menuli"><a href="./signup.php">Registrate</a></li>
          <li id="menuli"><a href="../index.php">Volver</a></li>
        </ul>
      </div>
    </nav>
</header>
    <section>

    <form action="#" method="POST">
        <div id="login-box">
            <h1>Iniciar Sesion</h1> 
            <?php if(!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
            <div class="form">
                <div class="item"> 
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <input type="text" placeholder="Correo" name="email">
                </div>

                <div class="item"> 
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" placeholder="Contraseña" name="password"> 
                </div>

            </div>
            
            <input type="submit" value="Submit"> 
        </div>
    </form>
    </section>

</body>
</html>