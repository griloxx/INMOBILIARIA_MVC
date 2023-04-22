<?php

define('TEMPLATES_URL', __DIR__ .'/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');


function incluirTemplates( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
};

function estaAutenticado()  {
    session_start();
    
    if (!$_SESSION['login']) {
        return header('Location: /');
    }
}

function debugear($variable) {
    echo "<pre>";
    echo var_dump($variable);
    echo "</pre>";

exit;
}

// Escapa / sanitizar  el html

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// validar tipo de contenido
function validarTipoContenido ($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarNotificaciones($codigo) {
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado/a correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado/a correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado/a correctamente';
            break;
        
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedereccionar(string $url) {
    //validar por url que sea un id valido, no inyerctar codigo sql cualquier usuario
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);


    if(!$id){
        header("Location: {$url}");
    }
    return $id;
}

// function limitarCadena ($cadena, $limite, $sufijo){
//     // si la longitud es mayor que el limite
//     if(strlen($cadena) > $limite) {
//         //corta la cadena y ponle un sufijo
//         return substr($cadena, 0, $limite) . $sufijo;
//     } else {
//         //si no entonces devuelve la cadena normal
//         return $cadena;
//     };
// };