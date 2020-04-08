<?php

$json = file_get_contents("https://api.kawalcorona.com");
$obj = json_decode($json);
$no = 0;
foreach ($obj as $objs) {

    echo $objs->attributes->Country_Region;
    echo "<br>";
    echo $objs->attributes->Confirmed;
    echo "<br>";
    echo $objs->attributes->Deaths;
    echo "<p>--------------------------------</p>";
}

// print_r($obj);
 ?>
