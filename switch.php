<?php

$dia = "martes";
switch ($dia){
    case "lunes":
        echo "Inicio de semana";
        break;
    case "martes":
        echo "Segundo dia";
        break;
    case "miercoles":
        echo "fin de semana";
        break;
    default:
        echo "Dia no registrado";
    
    }

$mes = 5;
switch($mes){
    case 1:
        echo "ENERO";
        break;
    case 2:
        echo "FEBRERO";
        break;
    case 3: 
        echo "Marzo";
        break;
    default:
        echo "Mes incorrecto";
}

echo "CALCULADORA MATEMATICA";

$a = (float) readline("Ingrese su número a: ");
$b = (float) readline("Ingrese su número b: ");
$op = (string) readline("Ingrese su operación (+, -, *, /, %): ");

switch($op){
    case "+":
        echo "Resultado: " . ($a + $b) . PHP_EOL;
        break;
    case "-":
        echo "Resultado: " . ($a - $b) . PHP_EOL;
        break;
    case "*":
        echo "Resultado: " . ($a * $b) . PHP_EOL;
        break;
    case "/":
        if ($b != 0){
            echo "Resultado: " . ($a / $b) . PHP_EOL; // devuelve decimales
        } else {
            echo "Error: No se puede dividir entre cero" . PHP_EOL;
        }
        break;
    case "%":
        echo "Resultado: " . ($a % $b) . PHP_EOL;
        break;
    default:
        echo "Opción Incorrecta" . PHP_EOL;
}