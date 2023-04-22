<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad) { ?>
<div class="anuncio">
    <picture>
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio 1">
    </picture>
    <div class="contenido-anuncio">
        <h3><?php echo $propiedad->titulo ?></h3>
        <p class="escondido"><?php echo substr($propiedad->descripcion, 0, 70) . "...";?></p>
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
        <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
            Ver Propiedad
        </a>
    </div><!--.contenido anuncio-->
</div><!--.anuncio-->
<?php } ?>
</div><!--.contenedor-anuncios-->
