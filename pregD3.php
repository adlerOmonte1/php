<?php
class Numero {
    public $var;
    public function __construct($var) {
        $this->var = $var;
    }
    public function esPrimo() {
        if ($this->var <= 1) {
            echo "No es primo";
            return;
        }
        for ($i = 2; $i <= sqrt($this->var); $i++) {
            if ($this->var % $i == 0) {
                echo "No es primo";
                return;
            }
        }
        echo "Si es primo";
    }
}

$num = new Numero(17);
$num->esPrimo();