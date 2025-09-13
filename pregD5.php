<?php
class Calculadora {
    private $a;
    private $b;
    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }
    public function sumar() {
        return $this->a + $this->b;
    }
    public function restar() {
        return $this->a - $this->b;
    }
    public function multiplicar() {
        return $this->a * $this->b;
    }
    public function dividir() {
        if ($this->b == 0) {
            return "Error: División entre cero no permitida.";
        }
        return $this->a / $this->b;
    }
}

$calc = new Calculadora(10, 2);
echo "Suma: " . $calc->sumar() . "\n";
echo "Resta: " . $calc->restar() . "\n";
echo "Multiplicación: " . $calc->multiplicar() . "\n";
echo "División: " . $calc->dividir() . "\n";
