<?php
    session_start();
    require 'functions.php';

    initialize_coin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quest</title>
</head>
<body>
    <h2>welcome to quest! please select the quest below</h2>
    <form action="" method="post">
        <button type="submit" name="quest" value="ruins">ruins</button> <h3>reward 10 coin, need sword x1</h3>
        <button type="submit" name="quest" value="deepsea">deepsea</button> <h3>reward 20 coin, need bow x1</h3>
        <button type="submit" name="quest" value="celestia">celestia</button> <h3>reward 50 coin, need claymore x1, shield x1</h3>
    </form>
    <br>
    <button onclick="location.href='index.php';">back</button>
    <br>
    <br>

    <?php 
            if (isset($messeg)) {
                echo "<p>$messeg</p>";
            }
        
        ?>


    <p>your item: </p>
    <?php
        if (isset($_SESSION['inventory']) && !empty($_SESSION['inventory'])) {
            foreach ($_SESSION['inventory'] as $item) {
                echo "<li>" . $item . "</li>";
            }
        } else {
            echo "<p>no item</p>";
        }
    
    
    ?>
    
</body>
</html>