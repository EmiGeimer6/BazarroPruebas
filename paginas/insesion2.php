<?php
    session_start();

    require 'conexion.php';
    
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT idclient, mailclient, contraclient  FROM clientes WHERE mailclient = :mailclient');
        $records->bindParam(':mailclient', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';

        if(!empty($results)){
            if (count($results) > 0 && password_verify($_POST['password'], $results['contraclient'])) {
                $_SESSION['user_id'] = $results['idclient'];
                header('Location: ../index.php');
              } else {
                $message = 'Contraseña o correo incorrectos';
              }
        }else{
            $message = 'Correo inexistente, intentalo de nuevo.';
        }
    
        
      }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css?ts=<?=time()?>" />
    <?php if(!empty($message)): ?>
    <link rel="stylesheet" type="text/css" href="../css/error.css?ts=<?=time()?>" />
    <?php endif; ?>
    <link rel="icon" href="../favicon.ico" style="max-width:150%;height:auto;" >
    <link rel="stylesheet" type="text/css" href="../css/nav.css?ts=<?=time()?>" />
    
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?ts=<?=time()?>" />
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <script src="https://kit.fontawesome.com/61c7880572.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
        <nav>
            <div id="brand">
                <div id="logo"><a href="../index.php"><img src="../imagenes/Logos/LogoNuevo.png" style="max-width:100%;height:auto;"></a></div>
            </div>

            <div id="menu"> 
                <ul id="navul">
                    <span class="material-symbols-outlined" id="menu_icon">menu</span>
                    
                    <?php if(!empty($user)): ?>
                    <li><a href="./paginas/logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                    <li><a href="signup2.php">Registrate</a></li>
                    <?php endif; ?>
                    <li id="menuli"><a href="../index.php">Inicio</a></li>
                    <li><a href="bazares.php">Articulos</a></li>
                    <li><a href="blog.php">Sobre nosotros</a></li>
                </ul>
            </div>
        </nav>
    </header>
                        <div class="formcont">
                        <form class="form" action="#" method="POST"  autocomplete="off">
                            <h2 class="form_title">Inicia sesion</h2>
                            <p class="form_paragraph">¿Aun no tienes una cuenta? <a class="form_link" href="signup2.php">Registrate</a></p>
                            <div class="form_container">
                                <?php if(!empty($message)): ?>
                                    <div class="mensaje"><?= $message ?></div>
                                <?php endif; ?>
                                <div class="form_group">
                                    <input type="email" name="email" class="form_input" placeholder=" " autocomplete="off">
                                    <label for="email" class="form_label">Correo:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="password" name="password" class="form_input" placeholder=" " autocomplete="off">
                                    <label for="password" class="form_label">Contraseña:</label>
                                    <span class="form_line"></span>
                                </div>
                                <input type="submit" class="form_submit" value="Entrar">
                            </div>
                        </form>
                        </div>
</body>
</html>