<?php
class MiArray{
    public $lista;
    public function __construct($lista)
    {
        $this->lista = $lista;
    }
    
    public function ordenamiento(){
        sort($this->lista);
        foreach ($this->lista as $ord){
            echo "$ord ";
        }
    }
}
$objeto1 = new MiArray([10,5,4,2,1,45]);
$objeto1->ordenamiento();