<?php 
    if(!isset($_POST['busqueda'])){
        header('Location: index.php');
    }
    
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Search: <?=$_POST['busqueda']?></h1>
    
    <?php
        $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);
        
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
    
                <article class="entrada">
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                        <span class="fecha"><?=$entrada['Categoría'].' | '.$entrada['fecha'].' | '.$entrada['usuario']?></span>
                        <p>
                            <?= substr($entrada['descripcion'], 0, 180).'...'?>
                        </p>
                    </a>
                </article>
    
    <?php
            endwhile; 
        else:
    ?>
    <div class="alerta alerta-error">There are no entries with "<?=$_POST['busqueda']?>".</div>
    <?php endif; ?>
    
</div><!-- FIN PRINCIPAL -->

<?php require_once 'includes/pie.php'; ?>