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

function complete_quest($quest) {
    if (isset($_SESSION['inventory']) && !empty($_SESSION['inventory'])) {
        foreach ($_SESSION['inventory'] as $item) {
            echo "<li>" . $item . "</li>";
        }
    } else {
        echo "<p>no item</p>";
    }
    switch ($quest) {
        case 'ruins' :
            if ($_SESSION['inventory']['sword'] >= 1) {
                $_SESSION['inventory']['sword'] -= 1;
                $_SESSION['coin'] += 10;
                return "quest 'ruin' completed! you earned 10 coin.";
            } else {
                return "not enough swords.";
            }
    }
}



if (isset($_POST['quest'])) {
    complete_quest($_POST['quest']);
}



?>