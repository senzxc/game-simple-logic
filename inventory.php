<?php
    session_start();
    require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inventory</title>
</head>
<body>
    <p>your coin <?= $_SESSION['coin']; ?><br></p>
    <p>item: </p>
    <ul>
    <?php
        if (isset($_SESSION['inventory']) && !empty($_SESSION['inventory'])) {
            foreach ($_SESSION['inventory'] as $item) {
                echo "<li>" . ucfirst($item) . "</li>";
            }
        } else {
            echo "<p>no item</p>";
        }
    ?>
    </ul>
    <button onclick="location.href='index.php';">back</button>
</body>
</html>