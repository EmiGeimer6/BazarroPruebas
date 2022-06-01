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

        $query = $conn -> prepare("SELECT mailclient FROM clientes ");
        $query->execute();
        foreach($query as $rows){
                if($rows['mailclient']==$_POST['email']){
                    $message = 'El correo ya existe';
                }
            
                }
                if(empty($message)){

                if ($stmt->execute()) {
                    $message = 'Se ha creado el usuario correctamente';
                    header('Location: ../index.php');
                    } else {
                    $message = 'Ha ocurrido un problema creando tu cuenta';
                    }
                }
                

        
      }
     
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" href="../favicon.ico" style="max-width:150%;height:auto;" >

    <link rel="stylesheet" type="text/css" href="../css/login2.css?ts=<?=time()?>" />
    
    <link rel="stylesheet" type="text/css" href="../css/nav.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/slider.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?ts=<?=time()?>" />
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <script src="https://kit.fontawesome.com/61c7880572.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
        <nav>
            <div id="brand">
           <a href="../index.php"><div id="logo"><img src="../imagenes/Logos/LogoNuevo.png" style="max-width:100%;height:auto;"></a></div>
            </div>

            <div id="menu"> 
                <ul id="navul">
                    <span class="material-symbols-outlined" id="menu_icon">menu</span>
                    
                    <?php if(!empty($user)): ?>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                    <li><a href="insesion2.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                    <li id="menuli"><a href="../index.php">Inicio</a></li>
                    <li><a href="bazares.php">Articulos</a></li>
                    <li><a href="blog.php">Sobre nosotros</a></li>
                </ul>
            </div>
        </nav>
    </header>
                       

                        <form class="form" action="signup2.php" method="POST" name="form1">
                            <h2 class="form_title">Registrate</h2>
                            <p class="form_paragraph">¿Ya tienes una cuenta? <a class="form_link" href="insesion2.php">Inicia sesion</a></p>
                            
                                <div class="mensaje" id="mensaje"> <?= $message ?></div>
                            
                            <div class="form_container">
                                
                                <div class="form_group">
                                    <input type="text" name="nom" class="form_input" placeholder=" " autocomplete="off"  pattern="[A-Za-z]+">
                                    <label for="nom" class="form_label">Nombre:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="text" name="apel" class="form_input" placeholder=" " autocomplete="off" pattern="[A-Za-z]+">
                                    <label for="apel" class="form_label">Apellidos:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="email" name="email" class="form_input" placeholder=" " autocomplete="off">
                                    <label for="email" class="form_label">Correo:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="password"  name="password" class="form_input" placeholder=" " autocomplete="off" minlength="5" maxlength="20"   pattern="[A-Za-z0-9]+" id="password">
                                    <label for="password" class="form_label">Contraseña:</label>
                                    <span class="form_line"></span>
                                </div>
                                
                                <div class="form_group">
                                    <input type="password"  name="password2" class="form_input" placeholder=" " autocomplete="off" minlength="5" maxlength="20"   pattern="[A-Za-z0-9]+" id="password2">
                                    <label for="password" class="form_label">Confirmar contraseña:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="text" name="nomuser" class="form_input" placeholder=" " autocomplete="off">
                                    <label for="nomuser" class="form_label">Usuario:</label>
                                    <span class="form_line"></span>
                                </div>
                                <div class="form_group">
                                    <input type="tel" name="tel" class="form_input" placeholder=" " autocomplete="off" minlength="10" maxlength="10" pattern="[0-9]+">
                                    <label for="tel" class="form_label">Telefono:</label>
                                    <span class="form_line"></span>
                                </div>
                                <input type="submit" id="submit" class="form_submit" value="Entrar" >
                            </div>
                        </form>
                        <script>
                            

                            function validar(){
                            let password = document.getElementById("password");
                            let password2 = document.getElementById("password2");
                            let submit =  document.getElementById("submit");
                            if (password.value != password2.value){ 
                                
                                document.getElementById("mensaje").innerHTML='Las contraseñas no coinciden';
                                password.style.backgroundColor ='rgba(223, 111, 111, 0.39)';
                                password2.style.backgroundColor ='rgba(223, 111, 111, 0.39)';
                                
                                submit.setAttribute("disabled","");
                                
                                
                                
                            }else{
                                document.getElementById("mensaje").innerHTML='';
                                password.style.backgroundColor ='initial';
                                password2.style.backgroundColor ='initial';
                                submit.removeAttribute("disabled","");
                            }

                            
                        }
                        var contra =document.getElementById("password2");
                        contra.addEventListener('change', validar);
                        document.getElementById("password").addEventListener('change', validar);
                    
                            
                        </script>
</body>
</html>