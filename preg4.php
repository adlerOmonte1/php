<?php
echo "TABLA DE MULTIPLICACION <br>";
#DE FORMA CONTINUA
$a = 6;
$b = 6;
for($i=1; $i<=$a;$i++){
    for($j=1; $j<=$b;$j++){

        $resultado = $i*$j;
        echo "$resultado ";
    }
    echo "<br>";
}
