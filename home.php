<?php
$kuota = array(
    array("Kaget 14GB", "14GB", "30 hari", 40000, "kuota-kaget.png"),
    array("Anti Cemas", "23GB", "30 hari", 100999, "kuota-cemas.png"),
    array("Kaget 5 GB", "5 GB", "15 hari", 17000, "kaget-5gb.png"),
    array("Kaget 65 GB", "65 GB", "30 Hari", 100000, "kuota-kaget.png"),
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket Kuota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light" style="background-color: #f5f5f5;"> <!-- Navbar dengan warna pink -->
        <div class="container-fluid">
            <div class="d-flex justify-content-between w-100">
                <div class="d-flex">
                    <img src="img/logo (1).png" alt="Logo" style="height: 50px;">
                    <a class="nav-link text-black mx-3 fs-5" href="#">Beranda</a>
                    <a class="nav-link text-black mx-3 fs-5" href="home.php">Paket</a>
                    <a class="nav-link text-black mx-3 fs-5" href="home.php">Rewads</a>
                    <a class="nav-link text-black mx-3 fs-5" href="home.php">Discover</a>
                    <a class="nav-link text-black mx-3 fs-5" href="home.php">Global Rank</a>
                </div>
                <a href="index.php" class="btn text-white mx-3 fs-5" style="background-color: #ba55d3;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Kartu Internet Dengan <br> Sinyal Terbaik</h1>
                <p>Nikmati dengan berbagai macam paket internet yang kami tawarkan.</p>
                <a href="#daftar-paket" class="btn text-white mx-3 fs-5" style="background-color: #ba55d3;">Lihat Paket</a>
                <a href="learn-more.php" class="ms-3">Learn More</a>
            </div>
            <div class="col-md-6 text-end">
                <img src="img/hero-img.png" class="img-fluid" alt="Banner">
            </div>
        </div>
    </div>

    <div class="container mt-5" id="hero">
        <h2 id="daftar-paket" class="mb-4">Daftar Paket Internet</h2>
        <div class="row">
            <?php foreach ($kuota as $index => $paket) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="img/<?= $paket[4] ?>" class="card-img-top" alt="<?= $paket[0] ?>" style="max-height: 200px; width: 90%; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-text"><?= $paket[0] ?></p>
                            <p class="card-text"><strong><?= $paket[1] ?></strong> | <?= $paket[2] ?></p>
                            <p class="card-text"><strong>Rp <?= number_format($paket[3], 0, ',', '.') ?></strong></p>
                            <a href="transaksi.php?id=<?= $index ?>" class="btn text-white px-3 py-1 fs-6" style="background-color: #ba55d3;">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>