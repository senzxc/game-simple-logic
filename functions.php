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
    $err_celestia = "not enuf claymore or shield, comebak later.";
    $comp_celestia = "quest 'celestia' completed! you earned 50 coin.";

    $err_deepsea = "not enuf bow, comebak later.";
    $comp_deepsea = "quest 'deepsea' completed! you earned 20 coin.";

    $err_ruin = "not enuf sword, comebak later.";
    $comp_ruin = "quest 'ruin' completed! you earned 10 coin.";

    switch ($quest) {
        case 'ruins' :
            if ($_SESSION['inventory']['sword'] >= 1) {
                $_SESSION['inventory']['sword'] -= 1;
                $_SESSION['coin'] += 10;
                return $comp_ruin;
            } else {
                return $err_ruin;
            }
        
        case 'deepsea' :
            if ($_SESSION['inventory']['bow'] >= 1) {
                $_SESSION['inventory']['bow'] -= 1;
                $_SESSION['coin'] += 20;
                return $comp_deepsea;
            } else {
                return $err_deepsea;
            }

        case 'celestia' :
            if ($_SESSION['inventory']['claymore'] && $_SESSION['inventory']['shield'] >= 1) {
                $_SESSION['inventory']['claymore'] -= 1;
                $_SESSION['inventory']['shield'] -= 1;
                $_SESSION['coin'] += 50;
                return $comp_celestia;
            } else {
                return $err_celestia;
            }

    }
}



if (isset($_POST['quest'])) {
    $messeg = complete_quest($_POST['quest']);
}



?>