<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="vendedor[apellido]" placeholder="Apellidos Vendedor" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono Vendedor" value="<?php echo s($vendedor->telefono); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="vendedor[imagen]" accept="image/jpeg, image/png">

    <?php if(basename($_SERVER['PHP_SELF']) === 'actualizar') { ?>
        <img src="/imagenes/<?php  echo $vendedor->imagen ?>" alt="Imagen Vendedor" class="imagen-tabla">
    <?php } ?>

</fieldset>
