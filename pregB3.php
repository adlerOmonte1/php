<?php
$temperaturas = [78,60,62,68,71,68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68,
62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];
$orden = $temperaturas;
sort($orden);
echo "<br>Ordenamiento con la funcion sort: <br>";
foreach($orden as $ord){
    echo "$ord ";
}
echo "<br>Promedios: <br>";

$sumMenores = 0;
$contadorMen = 0;
for($i=0; $i<5; $i++){
    $numero = $orden[$i];
    $sumMenores +=$numero;
    $contadorMen ++;
}

$sumMayores = 0;
$contadorMay = 0;
for($i=(count($orden)-1);$i>=(count($orden)-5);$i--){
    $numero = $orden[$i];
    $sumMayores +=$numero;
    $contadorMay ++;
}
echo "$sumMenores y $sumMayores <br>";
$promedio = ($sumMenores + $sumMayores)/($contadorMen+$contadorMay);
echo "$promedio <br>";

