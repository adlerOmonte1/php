<?php
$numeros = [10,5,3,78,12,41,4];
$contador = count($numeros);
for($i=0; $i <$contador -1;$i++){
    for($j=0;$j <($contador-$i-1);$j++){
        if($numeros[$j]>$numeros[$j+1] ){
            $temp = $numeros[$j];
            $numeros[$j] = $numeros[$j+1];
            $numeros[$j+1]  = $temp;
        }
    }
}
for($i=0; $i<$contador; $i++){
    echo "$numeros[$i] ";
}


