<?php
function esPalindromo($palabra){
    $palabra = strtolower(str_replace(' ','',$palabra));
    $letras = str_split($palabra);
    $conta = count($letras);
    for($i=0;$i<($conta/2);$i++){
        if($letras[$i]!== $letras[$conta-$i-1]){
            echo "La palabra $palabra no es un palindromo";
            return;
        }
    }
    echo "La cadena $palabra es palindromo";
}
esPalindromo("oso");