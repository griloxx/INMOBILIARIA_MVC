<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>
    <form  method="POST" action="/vendedores/crear" class="formulario" enctype="multipart/form-data">
    <?php include __DIR__ . '/formulario.php'; ?>

        <input type="hidden" name="tipo" value="vendedor" class="eliminar">
        <input type="submit" value="Registrar Vendedor" class="boton2 boton-verde">

    </form>
</main>