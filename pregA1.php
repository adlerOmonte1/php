<?php
$a = (int) readline("Ingrese su 1er numero: ");
$b = (int) readline("Ingrese su 2do numero: ");
$c = (int) readline(("Ingrese su 3er numero: "));
$rango = false;
#if ( $a>=20 && $a<=50 && $b>=20 && $b<=50 && $c>=20 && $c<=50){
#    $rango = true;
#}
#var_dump($rango);

if ($a>=20 && $a <= 50){
    $rango = true;
}elseif ( $b>=20 && $b<=50){
    $rango = true;
}elseif($c>= 20 && $c<=50){
    $rango = true;
}
#echo $rango;
var_dump($rango);