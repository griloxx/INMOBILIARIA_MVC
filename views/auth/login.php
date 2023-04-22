

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php }; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-Mail</label>
            <input type="email" name="email" placeholder="tu email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Contraseña" id="password" required>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton2 boton-verde">
    </form>

</main>