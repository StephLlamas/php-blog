<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Create category</h1>
    <p>
        Add new categories to the blog so that users can
        use them when creating their entries.
    </p>
    <br/>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Name</label>
        <input type="text" name="nombre" />
        
        <input type="submit" value="Save" />
    </form>
    
</div><!-- FIN PRINCIPAL -->

<?php require_once 'includes/pie.php'; ?>