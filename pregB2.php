<?php

$color = array(4 =>"blanco",6=>"verde",11=>"roja");
foreach($color as $orden => $col){
    echo "$orden => $col <br>";
}
echo "El resultado esperado es {$color[4]}";