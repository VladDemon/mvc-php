<?php

function pre ($str, $die = false) {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    if($die) {
        die();
    }
}
?>