<?php
session_start(); // Memulai sesi untuk menyimpan total harga

$kuota = array(
    array("Kaget 14GB", "14GB", "30 hari", 40000, "kuota-kaget.png"),
    array("Anti Cemas", "23GB", "30 hari", 100999, "kuota-cemas.png"),
    array("Kaget 5 GB", "5 GB", "15 hari", 17000, "kaget-5gb.png"),
    array("Kaget 65 GB", "65 GB", "30 Hari", 100000, "kuota-kaget.png"),
);

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (!isset($kuota[$id])) {
    die("Paket tidak ditemukan.");
}
$paketTerpilih = $kuota[$id];
$harga = $paketTerpilih[3];

// Variabel form
$notransaksi = "";
$namacustomer = "";
$tanggal = "";
$totalharga = $_SESSION['totalharga'] ?? 0; // Ambil total harga dari sesi jika ada
$pembayaran = 0;
$kembalian = 0;
$pesan = "";
$tambahan = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // pengecekkan apakah ada data yang dikirim menggunakan method post
    $notransaksi = $_POST['notransaksi']; // mengambil nilai dari inputan notransaksi dan disimpan ke $notransaksi
    $namacustomer = $_POST['namacustomer']; //mengambil nilai dari inputan namacustomer dan disimpan ke $namacustomer
    $tanggal = $_POST['tanggal']; //mengambil nilai dari inputan tanggal dan disimpan ke $tanggal
    $pembayaran = isset($_POST['pembayaran']) ? (int) $_POST['pembayaran'] : 0; // mngecek apkh ad data tambahan jika tdk ad maka defaultnya 0
    $jumlah = isset($_POST['jumlah']) ? (int) $_POST['jumlah'] : 1;
    $tambahan = isset($_POST['tambahan']) ? array_map('intval', $_POST['tambahan']) : [];
    $tambahan_total = array_sum($tambahan);

    if (isset($_POST['hitung_total'])) {
        $totalharga = ($harga * $jumlah) + $tambahan_total;
        $_SESSION['totalharga'] = $totalharga; // Simpan total harga di sesi
    }

    if (isset($_POST['hitung_kembalian'])) {
        if ($pembayaran >= $totalharga) {
            $kembalian = $pembayaran - $totalharga;
        } else {
            $kembalian = "Pembayaran tidak cukup";
        }
    }

    if (isset($_POST['simpan'])) {
        unset($_SESSION['totalharga']); // Hapus total harga dari sesi setelah transaksi selesai
        echo "<script>alert('Transaksi Berhasil!'); window.location.href = 'home.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <h3 class="text-center">TRANSAKSI</h3>
                            <div class="mb-3">
                                <label class="form-label">Nomor Transaksi</label>
                                <input type="text" class="form-control" name="notransaksi" value="<?= htmlspecialchars($notransaksi) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <input type="text" class="form-control" name="namacustomer" value="<?= htmlspecialchars($namacustomer) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Produk</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($paketTerpilih[0]) ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Produk</label>
                                <input type="text" class="form-control" name="harga" value="<?= $harga ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Produk</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= $jumlah ?>" min="1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tambahan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tambahan[]" value="10000" <?= in_array(10000, $tambahan) ? 'checked' : '' ?>>
                                    <label class="form-check-label">YouTube 2 GB - Rp 10.000</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tambahan[]" value="8000" <?= in_array(8000, $tambahan) ? 'checked' : '' ?>>
                                    <label class="form-check-label">TikTok 2 GB - Rp 8.000</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tambahan[]" value="12000" <?= in_array(12000, $tambahan) ? 'checked' : '' ?>>
                                    <label class="form-check-label">Netflix 2 GB - Rp 12.000</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark" name="hitung_total">Hitung Total Harga</button>
                            <div class="mb-3 mt-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="totalharga" value="<?= $totalharga ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pembayaran</label>
                                <input type="text" class="form-control" name="pembayaran" value="<?= $pembayaran ?>">
                            </div>
                            <button type="submit" class="btn btn-dark" name="hitung_kembalian">Hitung Kembalian</button>
                            <div class="mb-3 mt-3">
                                <label class="form-label">Kembalian</label>
                                <input type="text" class="form-control" name="kembalian" value="<?= $kembalian ?>" readonly>
                            </div>
                            <button type="submit" class="btn btn-dark" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>