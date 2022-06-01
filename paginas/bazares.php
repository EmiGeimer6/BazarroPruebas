<?php
  session_start();

  require 'conexion.php';
  if(isset($_GET['categ'])){
    $Categ = $_GET['categ'];
    $query = $conn -> prepare("SELECT * FROM articulos, bazares WHERE articulos.idbazar = bazares.idbazar AND articulos.tagsart = '$Categ' ");
  }else{
    $query = $conn -> prepare("SELECT * FROM articulos, bazares WHERE articulos.idbazar = bazares.idbazar");
  }
    
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
    <title>Bazares</title>
    <link rel="icon" href="../favicon.ico" style="max-width:150%;height:auto;" >
    <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
    
    <script src="../js/scripts.js"></script>

    <link rel="icon" href="favicon.ico" style="max-width:150%;height:auto;" >

    <link rel="stylesheet" type="text/css" href="../css/styles.css?ts=<?=time()?>" />
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
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                    <li><a href="insesion2.php">Iniciar Sesión</a></li>
                    <li><a href="signup2.php">Registrate</a></li>
                    <?php endif; ?>
                    <li id="menuli"><a href="../index.php">Volver</a></li>
                    <li><a href="blog.php">Sobre nosotros</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="banner">
        <h2>Articulos</h2>
    </div>
    <div class="categ" id="categ">
                        <a href="bazares.php#categ">Todos</a>
                        <a href="bazares.php?categ=Moda#categ">Moda</a>
                        <a href="bazares.php?categ=Deporte#categ">Deporte</a>
                        <a href="bazares.php?categ=Joyeria#categ" id="tagjoy">Joyeria</a>
                        <a href="bazares.php?categ=Comida#categ" id="tagcom">Comida</a>
            </div>
        <div class="page-content" id="page-content">
            <?php 
                    require("conexion.php");
                    
                    $query->execute();
                    foreach($query as $rows){?>
                      
                        <div class='product-container'>
                        <h3><?php echo $rows['nomart'] ?></h3>
                        <img src='<?php echo $rows['linkimgart'] ?>'/>
                        <div class='txt'>
                        <h1 class='precio'> <?php echo $rows['nombazar'] ?></h1>
                        <button class='button-add'><a href="<?php echo $rows['linkart'] ?>">Visitar</a> </button>
                        </div>
                        </div>
                       
                        <?php   }?>
                    
              

                
                
    
        </div>
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