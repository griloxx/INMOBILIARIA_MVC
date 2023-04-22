<?php

namespace Model;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
    public function validar($ext) {
        if(!$this->titulo) {
            static::$errores[] = "Debes añadir un titulo";
        };
    
        if(!$this->precio) {
            static::$errores[] = "Debes añadir un precio";
        };
    
        if(strlen($this->descripcion) < 50) {
            static::$errores[] = "Debes añadir una descripcion y debe tener al menos 50 caracteres";
        };
    
        if(!$this->habitaciones) {
            static::$errores[] = "El numero de habitaciones es obligatiorio";
        };
    
        if(!$this->wc) {
            static::$errores[] = "El numero de baños es obligatiorio";
        };
    
        if(!$this->estacionamiento) {
            static::$errores[] = "El numero de estacionamientos es obligatiorio";
        };
    
        if(!$this->vendedorId) {
            static::$errores[] = "Elige un vendedor";
        };
    
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