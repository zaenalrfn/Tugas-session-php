<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:form_buku.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUGAS 2 | HAK AKSES |PERTEMUAN 3</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
            <div class="flex justify-center mb-6">
                <span class="inline-block bg-gray-200 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                    </svg>
                </span>
            </div>
            <?php
            if (isset($_GET["login_gagal"])) {
            ?>
                <div class="text-center mb-2 text-red-500">login gagal! <br> Username atau Password
                    salah</div>
            <?php
            }
            ?>
            <h2 class="text-2xl font-semibold text-center mb-4">Yuk Login</h2>
            <p class="text-gray-600 text-center mb-6">Login dengan akun anda</p>
            <form method="post" action="validasi.php">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                    <input type="text" id="username" name="username" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="hello@alignui.com">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="••••••••">
                </div>
                <button type="submit" name="login" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Login</button>
                <p class="text-gray-600 text-xs text-center mt-4">
                    klik login
                </p>
            </form>
        </div>
    </div>
</body>

</html>