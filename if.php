<?php
$edad = 20;
if($edad >= 18){
    echo "eres mayor de edad <br>";
}

echo "Notas <br>";
$nota = 15;
if ( $nota >= 18){
    echo "Excelente";

} elseif ($nota >= 14 && $nota <= 17) {
    echo "Bueno";

} elseif ( 11<=$nota && $nota>=13){
    echo "Regular";
}else {
    echo "desaprobado";
}
echo "Sueldo <br>";

$sueldobase = 1500;
$anios = 2;
$desc = 0;
$sueldFinal = 0;
$bono = 0;
if ($anios <= 2){
    $desc = 0.05;
} elseif ($anios >= 3 && $anios <= 5){
    $desc = 0.10;
} elseif ( $anios > 5 && $anios <= 10){
    $desc = 0.15;
} elseif ($anios > 10 ){
    $desc = 0.20;
} 
$bono = $sueldobase * $desc;
$sueldFinal = $sueldobase + $bono;
if ($sueldFinal > 3000){
    echo "Su sueldo es: $sueldFinal <br>";
    echo "Debe de pagar impuestos";
} else {
    echo "Su sueldo es: $sueldFinal <br>";
    echo "No paga Impuestos";
}
