<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <?php include 'iconos.php'; ?>
</main>
<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>
    
    <?php
    include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuentra la Casa de tus Sueños</h2>
    <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo en brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contáctanos</a>
</section>
<div class="inferior contenedor seccion">
    <section class="blog">
        <h4>Nuestro Blog</h4>
        <article class="entrada">
            <picture>
                <source srcset="build/img/blog1.webp" type="image/webp">
                <source srcset="build/img/blog1.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/blog1.jpg" alt="imagen blog">
            </picture>
            <a href="/entrada">
                <h4>Terraza en el techo de tu casa</h4>
                <p class="parrafo-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
            </a>
        </article>
        <article class="entrada">
            <picture>
                <source srcset="build/img/blog2.webp" type="image/webp">
                <source srcset="build/img/blog2.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/blog2.jpg" alt="imagen blog">
            </picture>
            <a href="/entrada">
                <h4>Guía para la decoración de tu hogar</h4>
                <p class="parrafo-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
            </a>
        </article>
    </section>
    <section class="testimoniales">
        <h4>Testimoniales</h4>
        <div class="comentario">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Juan De la torre</p>
        </div>

    </section>
</div>