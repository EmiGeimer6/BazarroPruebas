<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idclient, mailclient,contraclient FROM clientes WHERE idclient = :idclient');
    $records->bindParam(':idclient', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazarro</title>
    <link rel="icon" href="../favicon.ico" style="max-width:150%;height:auto;" >
    <link rel="stylesheet" type="text/css" href="../css/blog.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/nav.css?ts=<?=time()?>" />
    <link rel="stylesheet" type="text/css" href="../css/responsive.css?ts=<?=time()?>" />
   
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://kit.fontawesome.com/61c7880572.js" crossorigin="anonymous"></script>
</head>
<body style="max-width:100%;height:auto;">
    <header>
      <nav>
      <div id="brand">
        <div id="logo"><a href="../index.php"><img src="../imagenes/Logos/LogoNuevo.png" style="max-width:100%;height:auto;"></a></div>
        <h1 id="titulo"><img src="../imagenes/Letras2.png"  alt=""></h1>
      </div>

      <div id="menu">
        <ul id="navul">
          <span class="material-symbols-outlined" id="menu_icon">menu</span>
          <?php if(!empty($user)): ?>
            <li><a href="logout.php">Cerrar Sesión</a></li>
          <?php else: ?>
          <li id="menuli"><a href="insesion2.php">Iniciar sesión</a></li>
          <li id="menuli"><a href="signup2.php">Registrate</a></li>
          <?php endif; ?>
          <li><a href="bazares.php">Articulos</a></li>
          <li id="menuli"><a href="../index.php">Volver</a></li>
        </ul>
      </div>
    </nav>
        
  </header>

    <section style="max-width:100%;height:auto;">
      <div id= "contenido">
        <div class="sobre">
        <h1 id="subtitulo">Sobre nosotros</h1>
        <div class="cont2">
        <p>Bazarro es un espacio que reune diferentes emprendimientos locales de jovenes trabajadores, ofreciendoles un lugar para promocionarse y crecer, todo esto como un apoyo a todos los servicios de nuestra localidad, Puerto Vallarta :)</p>
        <img src="../imagenes/Logos/LogoFF.png" alt="">
        </div>
      </div>
        <h2 id="subtitulo">Integrantes del equipo:</h2>
        <ul id="Content">
          <div class="Int"><li><div><h3>Emiliano Cervantes Gonzalez</h3> Contacto: 3221387632 <br> Correo: emicerg@gmail.com <br> Puesto: Desarrollador<br></div> <div> <img class="img"  src="../imagenes/nosotros/Emi.jpeg" alt="" > <br> </div></li></div>
          <div class="Int"><li><div><h3>Fabio Gomez Regalado</h3> Contacto: 3223322063 <br> Correo: fabiogears123@gmail.com <br> Puesto: Lider <br></div> <div> <img class="img"  src="../imagenes/nosotros/Fabio.jpeg" alt="" ></div></li></div>
          <div class="Int"><li><div><h3>Jose Omar Sosa Guerrero</h3> Contacto: 3223722146 <br> Correo: houmar0416@gmail.com <br> Puesto: Pruebas <br></div><div> <img class="img"  src="../imagenes/nosotros/Omar.jpeg" alt="" ></div></li></div>
          <div class="Int"><li><div><h3>Melany Sarahi Aldrete Ruelas</h3> Contacto: 3223207780 <br> Correo: melani.aldrete@gmail.com <br> Puesto: Diseñador <br></div> <div><img class="img"  src="../imagenes/nosotros/Markuus.jpeg" alt="" ></div> </li></div>
          <div class="Int"><li><div><h3>Marijose Mendia Mota</h3> Contacto: 3224295763 <br> Correo: memoma19650@gmail.com <br> Puesto: Analista <br></div><div> <img class="img" id="majo"  src="../imagenes/nosotros/Majo.jpeg" alt="" ></div> </li></div>
          
        </ul>
      </div>
    </section>
  
    <footer class="pie-pagina">
            <div class="grupo1">
                <div class="box">
                    <figure>
                        <a href="#">
                            <img src="../imagenes/Logos/LogoF.png" alt="Logo">
                        </a>
                    </figure>
                </div>
                <div class="box">
                    <h2>Sobre Nosotros</h2>
                    <hr>
                    <p>Bazarro es un espacio que reune diferentes emprendimientos locales de jovenes trabajadores, 
                    ofreciendoles un lugar para promocionarse y crecer, 
                    todo esto como un apoyo a todos los servicios de nuestra localidad.</p>
                    
                </div>
                <div class="box">
                    <h2>Siguenos
                    </h2>
                    <hr>
                    <div class="redsocial">
                        <a href="https://www.facebook.com/Bazarro-104194292295198" class="fa-brands fa-facebook-f"></a>
                        <a href="https://www.instagram.com/xxbazarroxx/" class="fa-brands fa-instagram"></a>
                    </div>
                </div>
            </div>
            <div class="grupo2">
                <small>&copy; 2021 <b>Bazarro</b> - Todos los derechos reservados.</small>
            </div>
       </footer>
</body>
</html>