<?php

// membuat user dan pass default
$Username = "userlsp";
$Password = "123";

// pengecekkan apakah ada data yang dikirim menggunakan method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $Username && $password === $Password) {
        header("Location: home.php");
        exit();
    } else {
        $errorMsg = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-secondary-subtle">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">
            </div>
        </div>
    </div>

    <div class="text-center">
        <div class="mb-3">
            <img src="img/logo (1).png" alt="Logo" class="rounded-circle" style="width: 100px; height: 100px;">
        </div>
        <h1>Login</h1>
        <h4 class="fw-bold">Masuk untuk melakukan proses top up</h4>

        <div class="card p-4 shadow-sm mt-3" style="max-width: 300px; margin: auto;">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn text-white px-3 py-1 fs-6 w-100" style="background-color: #ba55d3;">Continue</button>
            </form>
        </div>


        <!-- Peringatan untuk user atau pass salah -->
        <?php if (isset($errorMsg)) : ?>
            <p class="text-danger mt-3"><?= $errorMsg; ?></p>
        <?php endif; ?>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>