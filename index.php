<?php
session_start();

if (!isset($_SESSION['dataBarang'])) {
    $_SESSION['dataBarang'] = array();
}

if (isset($_POST['tambah'])) {
    if ($_POST['nama'] == "" && $_POST['harga'] == "" && $_POST['jumlah'] == "") {
        echo "Data Kosong!! <br>";
    } else {
        $jumHarga = $_POST['harga'] * $_POST['jumlah'];
        $barang = array(
            "nama" => $_POST['nama'],
            "harga" => $_POST['harga'],
            "jumlah" => $_POST['jumlah'],
            "jumHarga" => $jumHarga
        );
        array_push($_SESSION['dataBarang'], $barang);
    }
}

if (isset($_GET['delete'])) {
    $key = $_GET['delete'];
    unset($_SESSION['dataBarang'][$key]);

    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Venditor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        a {
            color: white; 
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-2 py-3">
        <h1 class="text-center">Toko Venditor</h1>
        <form action="" method="post">
            <div class="py-2">
                <label for="nama">Nama Barang :</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama barang">
            </div>
            <div class="py-2">
                <label for="harga">Harga Barang :</label>
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga barang">
            </div>
            <div class="py-2">
                <label for="jumlah">Jumlah Barang :</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah"
                    placeholder="Masukkan jumlah barang">
            </div>
            <div class="d-grid gap-2 d-md-block mb-2">
                <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
                <button class="btn btn-warning" type="submit"><a href="destroy.php">Reset</a></button>
            </div>
        </form>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <?php
            if (!empty($_SESSION['dataBarang'])) {
                $no = 1;
                foreach ($_SESSION['dataBarang'] as $key => $value) {
                    $total = $value['harga'] * $value['jumlah'];
                    $formatTotal = "Rp. " . number_format($total, 2, ',', '.');
                    $harga = "Rp. " . number_format($value['harga'], 2, ',', '.');
                    echo '
                        <tbody>
                            <tr>
                                <th scope="row">' . $no . '</th>
                                <td>' . $value['nama'] . '</td>
                                <td>' . $harga . '</td>
                                <td>' . $value['jumlah'] . '</td>
                                <td>' . $formatTotal . '</td>
                                <td><a href = "?delete=' . $key . '" class="btn btn-danger ms-2">Hapus</a></td>
                            </tr>';
                    $no++;
                }
            }
            ?>
            </tbody>
            <tr>
            <td style="border-top:2px solid black ;" class="" colspan="4">Total Harga</td>
                <td style="border-top: 2px solid black;">
                    <?php
                    $totalHarga = 0;
                    foreach ($_SESSION['dataBarang'] as $key) {
                        $totalHarga += $key['jumHarga'];
                    }
                    echo "total Rp. " . number_format($totalHarga, 2, ',', '.');
                    ?>
                </td>
                <td style="border-top: 2px solid black;"><a href="bayar.php" class="btn btn-primary" name="bayar">Bayar</a></td>
            </tr>
        </table>
    </div>
</body>

</html>