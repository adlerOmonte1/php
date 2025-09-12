<?php

$j = 1;
do {
    echo "valor: $j <br>";
    $j++;

}while($j <= 3); //SE DETIENE CUANDO EL WHILE SEA FALSO


$num = 10;

do {
    // Pedir número al usuario
    $numero = (int) readline("Ingrese un número para ver su tabla de multiplicar: ");

    // Mostrar tabla
    for ($i = 1; $i <= 10; $i++) {
        echo "$numero x $i = " . ($numero * $i) . PHP_EOL;
    }

    // Preguntar si quiere continuar
    $continuar = strtolower(readline("¿Quiere ver otra tabla? (si/no): "));

} while ($continuar == "si");

echo "✅ Programa terminado. ¡Gracias por usar el sistema!" . PHP_EOL;

