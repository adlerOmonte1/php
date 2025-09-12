<?php
$a = 15;
$b = 20;
$c = 8;

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
var_dump($rango);