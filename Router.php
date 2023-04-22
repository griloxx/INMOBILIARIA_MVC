<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }
    
    public function comprobarRutas() {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar',];

        $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI']; // sustituimos path_info de php por request_uri de apache para subirlo, $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        //$urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        //PATH_INFO // REQUEST_URI
        $medoto = $_SERVER['REQUEST_METHOD'];

        if ($medoto === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null; 
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
          // La URL existe y hay una funcion asociada
          call_user_func($fn, $this);
          } else {
              echo "Pagina No Encontrada";
          }
    }

    public function render($view, $datos = []) {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Almacenamiento en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        include __DIR__ . "/views/layout.php";

    }

}