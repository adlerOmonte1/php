<?php
$frutas = [ "Manzana","Pera","Uva"];
$i = 1;
foreach ( $frutas as $fruta){
    echo "$i : $fruta <br>";
    $i++;
}
$verduras = ["Apio"=> 1.5,"Poro" => 2.5,
            "Cebolla"=>1];
foreach ($verduras as $verdura =>$precio)
        echo "$verdura : $precio ";

###EJERCICIO

// Teoria de clave y valor " => "
// El primero es la clave y el 2do es el valor

$objetos = ["mesa"=>100,"reloj"=>200,"zapato"=>50];
$cosa = (string) readline("Ingrese el objeto: ");
$encontrado = false;
foreach ($objetos as $objeto =>$precio){
    if($objeto == $cosa){
        echo "$objeto cuesta S/. $precio";
        $encontrado = true;
        break;
    }
}
if($encontrado == false){
    echo "No existe";
}
