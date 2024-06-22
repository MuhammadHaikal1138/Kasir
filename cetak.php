<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>STRUK</title>
</head>
<body>
    <div class="container text-center">
        <h1>Struk Pembelian Anda</h1>
        <p><?php echo "Melakukan Transaksi Pada Tanggal: " . date("Y-m-d") ?></p>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["dataBarang"]) && !empty($_SESSION["dataBarang"])) 
                {
                    foreach ($_SESSION["dataBarang"] as $key) 
                    {
                    echo "<tr>";
                    echo "<td>" . ucfirst($key['nama']) . "</td>";
                    echo "<td>Rp " . number_format($key['harga'], 2, ',', '.') . "</td>";
                    echo "<td>" . $key['jumlah'] . "</td>";
                    echo "<td>Rp " . number_format($key['jumHarga'], 2, ',', '.') . "</td>";
                    echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="mb-4">
            <p class="fw-bold">Uang:  Rp. <?php echo number_format($_SESSION['uang'], 2, ',', '.'); ?>
            </p>
            <p class="fw-bold">Total Harga: Rp. <?php echo number_format($_SESSION['jumlahHarga'], 2, ',', '.'); ?></p>
            <?php if ($_SESSION['kembalian'] > 0): ?>
                <p class="fw-bold">Kembalian : Rp. <?php echo number_format($_SESSION['kembalian'], 2, ',', '.'); ?></p>
            <?php endif; ?>
        </div>
        <div class="d-grid gap-2">
            <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
            <a href="bayar.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</body>
</html>