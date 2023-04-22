<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>
    <form  method="POST"  class="formulario" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="hidden" name="tipo" value="vendedor" class="eliminar">
        <input type="submit" value="Guardar Cambios" class="boton2 boton-verde">

    </form>
</main>