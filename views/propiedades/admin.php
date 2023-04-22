<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php 
        if($resultado) {

        $mensaje = mostrarNotificaciones(intval($resultado));
        if($mensaje) {?>
            <p class="alerta insertado"><?php echo $_GET['t'] . s(" ") . s($mensaje); ?></p>

            <?php } 
        } ?>
            
        <!-- Botones crear -->
    <a href="/propiedades/crear" class="boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton-verde">Nueva Vendedor</a>
    
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--  mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) { ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td class="td-imagen"><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen"></td>
                <td><?php echo $propiedad->precio; ?>$</td>
                <td>
                    <form id="<?php echo "form". $propiedad->id?>" method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id ?>" class="eliminar">
                        <input type="hidden" name="tipo" value="propiedad" class="eliminar">
                        <input type="submit" value="Eliminar" class="boton-rojo-block eliminar" id="<?php echo "submit". $propiedad->id?>">
                    </form>
                    <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>">Actualizar</a>
                </td>
            </tr>
            <?php }; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--  mostrar los resultados -->
                <?php foreach ($vendedores as $vendedor) { ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form id="<?php echo "form". $vendedor->id?>" method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>" class="eliminar">
                            <input type="hidden" name="tipo" value="vendedor" class="eliminar">
                            <input type="submit" value="Eliminar" class="boton-rojo-block eliminar" id="<?php echo "submit". $vendedor->id?>">
                        </form>
                        <a class="boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id ?>">Actualizar</a>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
</main>