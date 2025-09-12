<?php
$i = 1;
while($i <=5 ){ // SE EJECUTA SI WHILE ES VERDADERO
    echo "Numero: $i <br>";
    $i++;
}
// CONTADOR, J ES EL NUMERO QUE USTED DESEE
$j = 12;

while($j >= 0){
    echo "$j <br>";
    $j--;
}
echo "Despegando";

// SUMA DE NUMEROS
$a = 10;
$sum = 0;
while($a >= 1){
    $sum +=$a; #va sumando automaticamente
    $a --; #menora hasta llegar a 1
}
echo "La suma total es: $sum";