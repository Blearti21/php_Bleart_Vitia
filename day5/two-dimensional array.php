<?php

$dogs=array(array("chiauua","Mexico","20"),array("Hysku","Poland","15"), array("Pitbull","England","10"));


/*
echo $dogs[0][0] . "Origina" . $dogs[0][1] . "Life Span" . $dogs[0][2] . '<br>';
echo $dogs[1][0] . "Origina" . $dogs[1][1] . "Life Span" . $dogs[1][2] . '<br>';
echo $dogs[2][0] . "Origina" . $dogs[2][1] . "Life Span" . $dogs[2][2] . '<br>';*/

for($row = 0; $row<3; $row++){

    echo "<p>Row number $row </p>";
    echo "<ul>";

    for($col=0; $col<3; $col++){
        echo "<li>" .$dogs[$row][$col]."</li>";
    };

    echo "</ul>";
}

//nested loop

for($i = 0;$i<3; $i++){
    echo $i . "<br>";
    for($j = 0;$j<3; $j++){
        echo $j ."numru mbrenda elementit <br>";
    }
}
?>