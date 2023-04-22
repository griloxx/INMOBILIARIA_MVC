<?php

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'imagen'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar($ext) {
        if(!$this->nombre) {
            static::$errores[] = "Debes añadir un nombre";
        };
    
        if(!$this->apellido) {
            static::$errores[] = "Debes añadir un apellido";
        };
    
        if(!$this->telefono) {
            static::$errores[] = "Debes añadir un numero de teléfono";
        };
        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            static::$errores[] = "Formato no valido";
        }
    
        if (!$this->imagen) {
            static::$errores[] = "La imagen es obligatoria";
        };
        if ($ext == '') {
            
        }else if ($ext !== 'jpg') {
            static::$errores[] = "La imagen tiene que ser .JPG";
        }
        return static::$errores;
    }
    

}