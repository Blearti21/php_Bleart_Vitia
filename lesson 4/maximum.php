<?php

function maximum($x,$y){
    if($x<$y){
        return $x;
    }else{
        return $y;  
    }
}
    
   

    


echo maximum(5,10);
echo"<br>";
echo maximum(3,50);
echo"<br>";
echo maximum(9,145);
echo"<br>";
echo maximum(4,2);

?>