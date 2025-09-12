<?php
$edad = 20;
if($edad >= 18){
    echo "eres mayor de edad";
}

$nota = 11;
if($nota >= 10.5){
    echo "Usted aprobo";
}else {
    echo "Desaprobaste";
}
$promedio = 15;

if ($promedio >= 18) {
    echo "Excelente";
} elseif ($promedio >= 14) {
    echo "Bueno";
} elseif ($promedio >= 11) {
    echo "Regular";
} else {
    echo "Desaprobado";
}
