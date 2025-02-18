<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Videogames Blog</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
    </head>
    <body>
        <!-- CABECERA -->
        <header id="cabecera">
            <!-- LOGO -->
            <div id="logo"> 
                <a href="index.php">
                    Videogames Blog
                </a>
            </div>
            
            <!-- MENÚ -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <?php 
                        $categorias = conseguirCategorias($db);
                        if(!empty($categorias)):
                            while ($categoria = mysqli_fetch_assoc($categorias)): 
                    ?>
                                <li>
                                    <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                                </li>
                    <?php
                            endwhile; 
                        endif;
                    ?>
<!--                    <li class="right-menu">
                        <a href="sobremi.php">About me</a>
                    </li>
                    <li class="right-menu">
                        <a href="contacto.php">Contact</a>
                    </li>-->
                </ul>
            </nav>
            
            <div class="clearfix"></div>
        </header>
        
        <div id="contenedor">