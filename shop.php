<?php
session_start();

// Definisikan harga setiap item
$prices = [
    'shield' => 3,
    'sword' => 5,
    'claymore' => 7,
    'bow' => 5,
    'spear' => 6
];

// Fungsi untuk menambah barang ke dalam keranjang belanja
function buy_item($item) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $item;
}

// Fungsi untuk membeli barang dari keranjang
// Fungsi untuk membeli barang dari keranjang
function checkout() {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $total_cost = 0;

        // Hitung total biaya barang yang dibeli
        foreach ($_SESSION['cart'] as $item) {
            global $prices; // Mengakses variabel $prices yang didefinisikan di luar
            $total_cost += $prices[$item]; // Tambahkan harga barang ke total
        }

        // Periksa apakah pengguna memiliki cukup koin
        if ($_SESSION['coin'] >= $total_cost) {
            $_SESSION['coin'] -= $total_cost; // Kurangi koin sesuai total biaya
            
            // Jika inventory belum ada, inisialisasi sebagai array kosong
            if (!isset($_SESSION['inventory'])) {
                $_SESSION['inventory'] = [];
            }
            
            foreach ($_SESSION['cart'] as $item) {
                if (isset($_SESSION['inventory'][$item])) {
                    $_SESSION['inventory'][$item]++;
                } else {
                    $_SESSION['inventory'][$item] = 1;
                }
            }
            
            $_SESSION['cart'] = []; // Kosongkan keranjang setelah pembelian
            return "Purchase successful! You bought " . implode(", ", $_SESSION['inventory']);
        } else {
            return "Not enough coins to complete the purchase.";
        }
    }
    return "Cart is empty.";
}

function reset_cart() {
    $_SESSION['cart'] = [];
}


// Memeriksa tombol mana yang ditekan dan memanggil fungsi buy_item()
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['shield'])) {
        buy_item('shield');
    } elseif (isset($_POST['sword'])) {
        buy_item('sword');
    } elseif (isset($_POST['claymore'])) {
        buy_item('claymore');
    } elseif (isset($_POST['bow'])) {
        buy_item('bow');
    } elseif (isset($_POST['spear'])) {
        buy_item('spear');
    } elseif (isset($_POST['checkout'])) {
        $message = checkout(); // Proses checkout
    } elseif (isset($_POST['reset'])) {
        reset_cart();
    }
}

$total_price = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $prices[$item]; // Hitung total harga
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <h1>your coin <?= $_SESSION['coin']; ?></h1>
    <h3>What do you want to buy?</h3>
    <form action="" method="post">
        <button type="submit" name="shield">Shield - $10</button>
        <button type="submit" name="sword">Sword - $15</button>
        <button type="submit" name="claymore">Claymore - $20</button>
        <button type="submit" name="bow">Bow - $12</button>
        <button type="submit" name="spear">Spear - $18</button>
        <br>
        <button type="submit" name="checkout">Checkout</button>
        <button type="submit" name="reset">Delete</button>
    </form>
    <br>
    <button onclick="location.href='index.php';">Back</button>

    <h3>Cart:</h3>
    <ul>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                echo "<li>" . ucfirst($item) . " - $" . $prices[$item] . "</li>"; // Menampilkan item dengan harga
            }
            echo "<p><strong>Total Price: $" . $total_price . "</strong></p>";
        } else {
            echo "<li>Cart is empty.</li>";
        }
        ?>
    </ul>

    <?php
    // Menampilkan pesan pembelian
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>
