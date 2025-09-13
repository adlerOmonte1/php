<?php
$a = 8;
$b = 8;
$c = 8;
if ( $a >= $b ){
    if($a >= $c){
        echo $a;
    }else{
        echo $c;
    }
}elseif($a < $b){
    if($b>=$c){
        echo $b;
    }else{
        echo $c;
    }
}