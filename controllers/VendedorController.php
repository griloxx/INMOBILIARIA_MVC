<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class VendedorController {

    public static function crear(Router $router) {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            /** Crea una nueva instancia */
            $vendedor = new Vendedor($_POST['vendedor']);
            
            /** Subida de archivos */
            
            
            $imagen = $_FILES['vendedor']['name'];
            $ext = pathinfo($imagen['imagen'], PATHINFO_EXTENSION); // extension del archivo para validar por jpg en clase (errores)
            if ($_FILES['vendedor']['name']['imagen']) { // hay que meter $nombreimagen en el if con el s_files para que cree el nombre con el aleatorio delante solo si hay foto, de lo contrario genera siempre el nombre aleatorio y no salta error por validacion al validar por nombre
                // Generar nombre unico para cada imagen y que no se reemplace
                $nombreImagen = md5(uniqid(rand(),true)) . $imagen['imagen'];
                // Setear la imagen
                $vendedor->setImagen($nombreImagen);
            }
            
            // Validar donde $ext es para validar por formato
            $errores = $vendedor->validar($ext);
            
            // revisar que el arreglo de errores este vacio
        
        
            if(empty($errores)){
                if($_FILES['vendedor']['tmp_name']['imagen']) {
                    // Realiza un resize a la imagen con intervention
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                    
                }
                
                // is_dir comprueba si existe o no
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
        
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                // Guardar en la base de datos
                $tipo = $_POST['tipo'];
                $vendedor->guardar($tipo);
        
            };
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores,
        ]);

    }

    public static function actualizar(Router $router) {

        $id = validarORedereccionar('/admin');

        $vendedores = Vendedor::all();
        $errores = Vendedor::getErrores();
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $args = $_POST['vendedor'];
        
            $vendedor->sincronizar($args);
        
        
            //subida de archivos
        
            $imagen = $_FILES['vendedor']['name'];
            $ext = pathinfo($imagen['imagen'], PATHINFO_EXTENSION); // extension del archivo para validar por jpg en clase (errores)
            if ($_FILES['vendedor']['name']['imagen']) { // hay que meter $nombreimagen en el if con el s_files para que cree el nombre con el aleatorio delante solo si hay foto, de lo contrario genera siempre el nombre aleatorio y no salta error por validacion al validar por nombre
                // Generar nombre unico para cada imagen y que no se reemplace
                $nombreImagen = md5(uniqid(rand(),true)) . $imagen['imagen'];
                // Setear la imagen
                $vendedor->setImagen($nombreImagen);
            }
            
            // Validar donde $ext es para validar por formato
            $errores = $vendedor->validar($ext);
        
        
            if(empty($errores)){
                // almacenar la imagen
                if($_FILES['vendedor']['tmp_name']['imagen']) { // si existe imagen nueva la guarda y borra la anterior con el setimagen si no no ejecuta y pasa a lo siguiente
                    $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                // Guardar en la base de datos
                $tipo = $_POST['tipo'];
                
                $vendedor->guardar($tipo);
        
            };
        }

        $router->render('vendedores/actualizar', [

            'vendedores' => $vendedores,
            'errores' => $errores,
            'vendedor' => $vendedor

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
                    $vendedor = Vendedor::find($id);
                    $vendedor = $vendedor->eliminar($tipo);
                }
            };
        };

    }

}