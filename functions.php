<?php

function initialize_coin() {
    if (!isset($_SESSION['coin'])) {
        $_SESSION['coin'] = 0;
    }
}

function add_coin() {
    if (isset($_POST['add_coin'])) {
        $_SESSION['coin'] += 5;
    }
}

function get_coin() {
    return $_SESSION['coin'] ?? 0;
}

?>