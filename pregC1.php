<?php
function calcularFactorial($var){
    $factorial= 1;
    for($i=1;$i<=$var;$i++){
        $factorial *=$i;
    }
    return $factorial;
}
echo "El factorial es: ".calcularFactorial(4);
