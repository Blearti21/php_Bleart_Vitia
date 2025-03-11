<?php

function plot($n){

    if(($n % 2)==0){
        return "$n eshte i plotpjestueshme me 2";
    }else{
        return "$n nuk eshte i plotpjestueshme me 2" ;
    }
}

print_r(plot(10)."<br>");
print_r(plot(3). "<br>");
print_r(plot(16). "<br>");


?>