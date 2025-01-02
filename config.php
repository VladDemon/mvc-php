<?php

function pre ($str, $die = false) : void {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    if($die) die();
}

?>