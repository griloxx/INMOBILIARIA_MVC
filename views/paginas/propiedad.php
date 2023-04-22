<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <div class="imagen-anuncio">
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen casa alberca">
    </div>
    <div class="propiedades-anuncio">
        <p class="precio"><?php echo $propiedad->precio; ?>$</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono coches">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p>
        <?php echo $propiedad->descripcion; ?>
        </p>
    </div>
</main>