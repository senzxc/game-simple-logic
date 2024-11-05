<?php
    session_start();
    require 'functions.php';

    initialize_coin();

    if (isset($_POST['add_coin'])) {
        add_coin();
    }

    $coin = get_coin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gim</title>
</head>
<body>
    <form action="" method="post">
        <button type="submit" name="add_coin">take this coim</button>
    </form>
    <br>
    <button onclick="location.href='quest.php';"></button>
    <button onclick="location.href='shop.php';">Shop</button>
    <button onclick="location.href='inventory.php';">inventory</button><br>
    <?= $coin; ?>
</body>
</html>