<?php

function pre(...$params): void {
    $lastParam = array_pop($params);
    $die = (isset($lastParam) && ($lastParam === 1 || $lastParam === true));
    echo "<pre style='background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 10px; border-radius: 5px;'>";
    foreach ($params as $param) {
        print_r(htmlspecialchars(print_r($param, true)));
        echo "\n";
    }
    echo "</pre>";
    if ($die) {
        die();
    }
}
?>