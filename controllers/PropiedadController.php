<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController {
    public static function index(Router $router) {
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['r'] ?? null;
        $resultado2 = $_GET['t'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'resultado2' => $resultado2,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //arreglo con mensaje de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            /** Crea una nueva instancia */
            $propiedad = new Propiedad($_POST['propiedad']);
            
            /** Subida de archivos */
            
            $imagen = $_FILES['propiedad']['name'];
            $ext = pathinfo($imagen['imagen'], PATHINFO_EXTENSION); // extension del archivo para validar por jpg en clase (errores)
            if ($_FILES['propiedad']['name']['imagen']) { // hay que meter $nombreimagen en el if con el s_files para que cree el nombre con el aleatorio delante solo si hay foto, de lo contrario genera siempre el nombre aleatorio y no salta error por validacion al validar por nombre
                // Generar nombre unico para cada imagen y que no se reemplace
                $nombreImagen = md5(uniqid(rand(),true)) . $imagen['imagen'];
                // Setear la imagen
                $propiedad->setImagen($nombreImagen);
            }
            
            // Validar donde $ext es para validar por formato
            $errores = $propiedad->validar($ext);
            
            // revisar que el arreglo de errores este vacio
            
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Realiza un resize a la imagen con intervention
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    
                }
        
                // is_dir comprueba si existe o no
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
        
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                // Guardar en la base de datos
                $tipo = $_POST['tipo'];
                $propiedad->guardar($tipo);
        
            };
        
            
        
            
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            
        ]);
        
    }
    public static function actualizar(Router $router) {
        
        $id = validarORedereccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Asignar los atributos
            $args = $_POST['propiedad'];
            
           
        
            $propiedad->sincronizar($args);
            
            
        
            //subida de archivos
        
            $imagen = $_FILES['propiedad']['name'];
            $ext = pathinfo($imagen['imagen'], PATHINFO_EXTENSION); // extension del archivo para validar por jpg en clase (errores)
            if ($_FILES['propiedad']['name']['imagen']) { // hay que meter $nombreimagen en el if con el s_files para que cree el nombre con el aleatorio delante solo si hay foto, de lo contrario genera siempre el nombre aleatorio y no salta error por validacion al validar por nombre
                // Generar nombre unico para cada imagen y que no se reemplace
                $nombreImagen = md5(uniqid(rand(),true)) . $imagen['imagen'];
            }
            // Setear la imagen
            $propiedad->setImagen($nombreImagen);
            
            // Validar donde $ext es para validar por formato
            $errores = $propiedad->validar($ext);
            
        
            if(empty($errores)){
                // almacenar la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']) { // si existe imagen nueva la guarda y borra la anterior con el setimagen si no no ejecuta y pasa a lo siguiente
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                // actualizar la base de datos
                $tipo = $_POST['tipo'];
                
                $propiedad->guardar($tipo);
            };
           
            
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);

    }

    public static function eliminar() {

        // Boton de eliminar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {

                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar($tipo);
                }
            };
        };


    }

}