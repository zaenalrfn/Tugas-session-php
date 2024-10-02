<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

// Inisialisasi variabel untuk menghindari undefined variable
$nama = $email = $komentar = "";
$namaError = $emailError = $komentarError = "";

// Jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nama"])) {
        $namaError = "Nama wajib diisi";
    } else {
        $nama = sanitize_input($_POST["nama"]);
    }

    if (empty($_POST["email"])) {
        $emailError = "Email wajib diisi";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Format email tidak valid";
        }
    }

    if (empty($_POST["komentar"])) {
        $komentarError = "Komentar wajib diisi";
    } else {
        $komentar = sanitize_input($_POST["komentar"]);
    }

    if (empty($namaError) && empty($emailError) && empty($komentarError)) {
        $_SESSION['buku_tamu'][] = [
            'nama' => $nama,
            'email' => $email,
            'komentar' => $komentar
        ];
    }
}

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form method="post" action="logout.php">
        <div class="p-6 border-t border-gray-200 rounded-b">
            <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Logout</button>
        </div>
    </form>
    <div class="bg-white border border-4 rounded-lg shadow relative m-10">
        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold">Buku Tamu</h3>
        </div>


        <div class="p-6 space-y-6">
            <form method="POST" novalidate>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="nama" class="text-sm font-medium text-gray-900 block mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" value="<?= $nama ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="aku" required>
                        <small class="text-red-500"><?= $namaError ?></small>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <input type="email" name="email" id="email" value="<?= $email ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="contoh@gmail.com" required>
                        <small class="text-red-500"><?= $emailError ?></small>
                    </div>
                    <div class="col-span-full">
                        <label for="komentar" class="text-sm font-medium text-gray-900 block mb-2">Komentar</label>
                        <textarea id="komentar" name="komentar" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4" placeholder="komentar" required><?= $komentar ?></textarea>
                        <small class="text-red-500"><?= $komentarError ?></small>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-200 rounded-b">
                    <button class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
        </div>

        <!-- data buku tamu -->

        <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Komentar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($_SESSION['buku_tamu'])): ?>
                                <?php foreach ($_SESSION['buku_tamu'] as $data): ?>
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold text-black"><?= htmlspecialchars($data['nama']) ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border"><?= htmlspecialchars($data['email']) ?></td>
                                        <td class="px-4 py-3 text-sm border"><?= htmlspecialchars($data['komentar']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="text-gray-700">
                                    <td colspan="3" class="px-4 py-3 text-center border">Belum ada data buku tamu</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</body>

</html>