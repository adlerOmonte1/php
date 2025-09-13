<?php
function fraseMinuscula($cadena){
    if($cadena === strtolower($cadena)){
        echo "La cadena $cadena esta en minusculas";
    } else {
        echo "La cadena $cadena no esta en minusculas";
    }
}
fraseMinuscula("hola");