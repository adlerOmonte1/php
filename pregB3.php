<?php
$temperaturas = [78,60,62,68,71,68,73,85,66,64,76,63,75,76,73,68,
62,73,72,65,74,62,62,65,64,68,73,75,79,73];

sort($temperaturas);

echo "<br>Ordenamiento con la funcion sort: <br>";
foreach($temperaturas as $temp){
    echo "$temp ";
}

$suma = array_sum($temperaturas);
$cantidad = count($temperaturas);
$promedio = $suma / $cantidad;

echo "<br>Promedio general de temperaturas: $promedio<br>";

echo "Las 5 temperaturas más bajas: ";
for ($i = 0; $i < 5; $i++) {
    echo $temperaturas[$i] . " ";
}
echo "<br>Las 5 temperaturas más altas: ";
for ($i = $cantidad - 5; $i < $cantidad; $i++) {
    echo $temperaturas[$i] . " ";
}
