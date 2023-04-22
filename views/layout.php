<?php 


$auth = $_SESSION['login'] ?? null;

if(!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header id="navigation" class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a class="logo" href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="derecha">
                    <img class="dark-mode" src="/build/img/dark-mode.svg" alt="Dark Mode">
                    <div class="boton" >
                            <span class="spn"></span>
                            <span class="spn"></span>
                            <span class="spn"></span>
                    </div>
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) { ?>
                        <a href="/logout">Cerrar sesion</a>
                        <?php }; ?>
                    </nav>
                </div>
            </div>
            <?php if ($inicio) {?>
            <h1 class="heading">Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php }; ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
            <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
        </div>
    </footer>
    <script src="/build/js/bundle.js"></script>
</body>
</html>