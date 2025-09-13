<?php
$a = 80;
$b = 80;
const resta = 100;
$c = resta - $a;
$d = resta - $b;
if ($a == $b){
    echo "0";
}elseif ($c > $d ){
    echo $b;
}else {
    echo $a;
}

