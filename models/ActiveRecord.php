<?php
namespace Model;

class ActiveRecord {
    
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];


    // public $id;
    // public $titulo;
    // public $precio;
    // public $imagen;
    // public $descripcion;
    // public $habitaciones;
    // public $wc;
    // public $estacionamiento;
    // public $creado;
    // public $vendedorId;

    // Definir la conexion a la DB
    public static function setDB($database) {
        self::$db = $database; //  Aquí si se puede utilizar self ya que la clases hijas van a llamar a la misma DB
    }

    // public function __construct($args = [])
    // {
    //     $this->id = $args['id'] ?? '';
    //     $this->titulo = $args['titulo'] ?? '';
    //     $this->precio = $args['precio'] ?? '';
    //     $this->imagen = $args['imagen'] ?? '';
    //     $this->descripcion = $args['descripcion'] ?? '';
    //     $this->habitaciones = $args['habitaciones'] ?? '';
    //     $this->wc = $args['wc'] ?? '';
    //     $this->estacionamiento = $args['estacionamiento'] ?? '';
    //     $this->creado = date('Y/m/d');
    //     $this->vendedorId = $args['vendedorId'] ?? 1;
    // }
    public function guardar($tipo) {
        if(!empty($this->id)){
            // actualizar
            $this->actualizar($tipo);
        } else {
            // crear
            $this->crear($tipo);
        }
    }

    public function crear($tipo) {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //INSERTAR EN LA BASE DE DATOS
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        

        $resultado = self::$db->query($query); // para db solo es una conexion en la clase padre se deja self

        // Mensaje de exito
        if($resultado) {
            //si el formulario se relleno correctamente
            // resetear post para que no se reenvie muchas veces por acciones de usuarios.
            unset($_POST);
            
            // redireccionar al usuario mas mensaje en get para utilizarlo en mensaje que muestre que se envió correctamente.
            
            header('Location: /admin?r=1&t=' . $tipo);

            exit;
        };
    }

    public function actualizar($tipo) {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";  // para db solo es una conexion en la clase padre se deja self
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);  // para db solo es una conexion en la clase padre se deja self

        if($resultado) {
            //si el formulario se relleno correctamente
            // resetear post para que no se reenvie muchas veces por acciones de usuarios.
            unset($_POST);
            
            // redireccionar al usuario mas mensaje en get para utilizarlo en mensaje que muestre que se envió correctamente.
            
            header('Location: /admin?r=2&t=' . $tipo);

            exit;
        };
    }

    // Eliminar un registro

    public function eliminar($tipo) {
        //eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . static::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);  // para db solo es una conexion en la clase padre se deja self

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?r=3&t=' . $tipo);
        }
    }

    // Identificar y unir los atributos de la DB
    public function atributos() {  // Mapear los datos del $_post que se reciben en el formulario y tenerlos en memoria para poder sanitizarlos
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() { // Sanitizar los datos para ello tienen que estar en memoria
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    // Subida de archivos (imagen)
    public function setImagen($imagen) {
        // Eliminar la imagen previa
        $ext = pathinfo($imagen, PATHINFO_EXTENSION);
        if(!is_null($this->id) && $imagen && $ext == 'jpg') { // tambien me vale isset
            // comprobar si existe el archivo
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
          //eliminar el archivo
        
          $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
          if($existeArchivo){
              unlink(CARPETA_IMAGENES . $this->imagen);
          }
    }

    // Validacion
    public static function getErrores() {

        return static::$errores;
    }

    public function validar($ext) {
       
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas las propiedades

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    //Obtener determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id ASC". " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    // Busca una propiedad por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
        
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario

    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

}