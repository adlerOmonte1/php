<?php

function calcularTipoNumero($var){
    
    for($i = 2; $i<=sqrt($var);$i++){
        if($var % $i == 0){
            return false;
        }
    } 
    return true;
}
if (calcularTipoNumero(2)) {
    echo "Si es número primo";
} else {
    echo "No es número primo";
}