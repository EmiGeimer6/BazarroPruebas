<?php
    require 'conexion.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['apel']) && !empty($_POST['nomuser'])) {
        $sql = "INSERT INTO clientes (nomclient, apelclient,mailclient,telclient,contraclient,userclient) VALUES (:nomclient,:apelclient,:mailclient,:telclient,:contraclient,:userclient)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':mailclient', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':contraclient', $password);
        $stmt->bindParam(':nomclient', $_POST['nom']);
        $stmt->bindParam(':apelclient', $_POST['apel']);
        $stmt->bindParam(':userclient', $_POST['nomuser']);
        $stmt->bindParam(':telclient', $_POST['tel']);
    
        if ($stmt->execute()) {
          $message = 'Successfully created new user';
        } else {
          $message = 'Sorry there must have been an issue creating your account';
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

    <title>Registrate</title>
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
          <li id="menuli"><a href="./insesion.php">Iniciar Sesion</a></li>
          <li id="menuli"><a href="../index.php">Volver</a></li>
        </ul>
      </div>
    </nav>
</header>
    <section>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <form action="signup.php" method="POST">
        <div id="login-box">
            <h1>Registrate</h1> 

            <div class="form">
                <div class="item"> 
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <input type="text" placeholder="Correo" name="email">
                </div>

                
                <div class="item"> 
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" placeholder="Contraseña" name="password"> 
                </div>
                <div class="item"> 
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" placeholder="Confirmar Contraseña" name="password"> 
                </div>
                <div class="item"> 
                    <i></i>
                    <input type="text" placeholder="Nombre" name="nom"> 
                </div>
                <div class="item"> 
                    <i></i>
                    <input type="text" placeholder="Apellidos" name="apel"> 
                </div>
                <div class="item"> 
                    <i></i>
                    <input type="text" placeholder="Nombre de Usuario" name="nomuser"> 
                </div>
                <div class="item"> 
                    <i></i>
                    <input type="tel" placeholder="Telefono" name="tel"> 
                </div>

            </div>
            
            <input type="submit" value="Submit"> 
        </div>
    </form>
    </section>

</body>
</html>