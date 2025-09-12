<?php

for($k = 1; $k<=5; $k++){
    echo "Iteracion $k <br>";

}

echo "TABLA DE MULTIPLICAR 7";
$i=7;
for($j = 0;$j <=12; $j++ ){
    echo "$i x $j es .  ".$j*$i."<br>" ;
}

echo "  NUMERO PARES";
$conta = 0;
for($j = 0; $j<=50; $j++){
    if($j%2 == 0){
        echo "Numero: $j.<br>";
        $conta++;
    }
}
echo "Numeros en Total: $conta ";

echo "NÚMEROS PRIMOS DEL 1 AL 50 <br>";

$contadorPrimos = 0;

for($num = 2; $num <= 50; $num++){  // empezamos en 2 porque 1 no es primo
    $esPrimo = true;

    // Verificar si $num es divisible entre algún número menor que él
    for($i = 2; $i < $num; $i++){
        if($num % $i == 0){
            $esPrimo = false;
            break; // si ya encontramos un divisor, no es necesario seguir
        }
    }

    if($esPrimo){
        echo "Primo: $num <br>";
        $contadorPrimos++;
    }
}

echo "<br>Total de primos encontrados: $contadorPrimos";



echo "TABLA DE MULTIPLICAR:";
for ($a = 1 ; $a <= 10; $a++){
    for($b=1; $b<=10; $b++){
        echo "$a * $b = ".$a*$b. "<br>";
    }
    echo "<br>";
}