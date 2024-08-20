<?php 

function env($value, $default = null) {
    return isset($_ENV[$value]) ? $_ENV[$value] : $default;
}