
<main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php } ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">

            <?php include __DIR__ . '/formulario.php'; ?>

            <input type="hidden" name="tipo" value="propiedad" class="eliminar">
            <input type="submit" value="Actualizar Propiedad" class="boton2 boton-verde">
        </form>
</main>