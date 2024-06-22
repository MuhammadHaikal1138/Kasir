<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Venditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2 py-3">
        <h1 class="text-center">Pembayaran Toko Venditor</h1>
        <form action="" method="post">
            <div class="py-2">
                <label for="uang">Masukkan Nominal Uang :</label>
                <input type="number" class="form-control" name="uang" id="uang" placeholder="Masukkan nominal uang..." required>
            </div>
            <?php
            $_SESSION['jumlahHarga'] = 0;

            if($_SESSION['dataBarang'] && !empty($_SESSION['dataBarang'])) {
                foreach ($_SESSION['dataBarang'] as $key ) {
                    $_SESSION['jumlahHarga'] += $key['jumHarga'];
                }
                echo "<p>Total Harga : Rp. " . number_format($_SESSION['jumlahHarga'], 2, ',', '.') . "</p>";
            }

            if (isset($_POST['beli'])) {
                $uang = $_POST['uang'];
                $_SESSION['kembalian'] = $uang - $_SESSION['jumlahHarga'];

                if ($uang < $_SESSION['jumlahHarga']) {
                    $kurangUang = $_SESSION['jumlahHarga'] - $uang;

                    echo "<p class='alert alert-danger'>Pembelian Tidak Berhasil <br>
                        Uang kamu kurang sebesar : Rp. ". number_format($kurangUang,2,',','.')."</p>";
                    } else { 
                        $_SESSION['uang'] = $uang;
                        echo "<p class='alert alert-success'>Pembelian berhasil <br>
                        Kembalian : Rp. " . number_format($_SESSION['kembalian'],2,',','.'). "</p>";
                        header("location: cetak.php");
                }
            }

                        
            
            
            ?>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary" type="submit" name="beli">bayar</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>