<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;
use Model\Propiedad;

class LoginController {

    public static function login(Router $router) {

        $errores = [];
        

        $auth = $_SESSION['login'] ?? null;

        if (isset($auth)) {
            return header('Location: /admin');
        }
        
        
        

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ext = null;
            $auth = new Admin($_POST);
            $errores = $auth->validar($ext);
            if(empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    // Mensaje de error si no verifica
                    $errores = Admin::getErrores();
                } else {
                // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) {
                        // Autenticar al usuario
                        $auth->autenticar();
                    } else {
                        // Password incorrecto 
                        $errores = Admin::getErrores();
                    }

                }
                
            }
        }


        $router->render('auth/login', [
            
            'errores' => $errores
            

        ]);
    }
    public static function logout() {

        session_start();

        $_SESSION = [];

        header('Location: /');

        
    }

}