<?php
class Pregunta{
    public function __construct()
    {
        
    }
    public $nombre;
    public function saludar(){
        echo "Hola a todos, soy ".$this->nombre;
    }

}
$pregunta1 = new Pregunta();
$pregunta1->nombre = "Adler";
$pregunta1->saludar();