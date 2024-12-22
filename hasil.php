<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hp";

$selectdb = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($selectdb->connect_error) {
    die("Connection failed: " . $selectdb->connect_error);
}

// Ambil data dari form
$harga = intval($_POST['harga']);
$ram = intval($_POST['ram']);
$memori = intval($_POST['memori']);
$processor = intval($_POST['processor']);
$kamera = intval($_POST['kamera']);

// Query untuk mendapatkan rekomendasi handphone
$sql = "SELECT * FROM data_hp WHERE 
            harga_angka >= $harga AND 
            ram_angka >= $ram AND 
            memori_angka >= $memori AND 
            processor_angka >= $processor AND 
            kamera_angka >= $kamera
        ORDER BY harga_angka DESC, ram_angka DESC, memori_angka DESC, processor_angka DESC, kamera_angka DESC";

$result = $selectdb->query($sql);

// Query untuk matriks perhitungan
$matrixQuery = "SELECT id_hp, nama_hp, harga_angka, ram_angka, memori_angka, processor_angka, kamera_angka FROM data_hp";
$matrixResult = $selectdb->query($matrixQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi Smartphone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto py-10">
        <h1 class="text-center text-2xl font-bold mb-6">Hasil Rekomendasi Smartphone</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table-auto w-full border-collapse border border-gray-200 mb-10">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nama HP</th>
                        <th class="border border-gray-300 px-4 py-2">Harga</th>
                        <th class="border border-gray-300 px-4 py-2">RAM</th>
                        <th class="border border-gray-300 px-4 py-2">Memori</th>
                        <th class="border border-gray-300 px-4 py-2">Processor</th>
                        <th class="border border-gray-300 px-4 py-2">Kamera</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['nama_hp']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">Rp. <?= number_format((int)$row['harga_hp']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['ram_hp']); ?> GB</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['memori_hp']); ?> GB</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['processor_hp']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['kamera_hp']); ?> MP</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-lg">Maaf, tidak ada smartphone yang cocok dengan kriteria Anda.</p>
        <?php endif; ?>

        <h2 class="text-center text-xl font-bold mt-10 mb-6">Matriks Perhitungan</h2>
        <?php if ($matrixResult->num_rows > 0): ?>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nama HP</th>
                        <th class="border border-gray-300 px-4 py-2">Harga</th>
                        <th class="border border-gray-300 px-4 py-2">RAM</th>
                        <th class="border border-gray-300 px-4 py-2">Memori</th>
                        <th class="border border-gray-300 px-4 py-2">Processor</th>
                        <th class="border border-gray-300 px-4 py-2">Kamera</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $matrixResult->fetch_assoc()): ?>
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['id_hp']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['nama_hp']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['harga_angka']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['ram_angka']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['memori_angka']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['processor_angka']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['kamera_angka']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-lg">Matriks data tidak tersedia.</p>
        <?php endif; ?>

        <div class="text-center mt-6">
            <a href="index.php" class="bg-black text-white px-6 py-2 rounded shadow hover:bg-white hover:text-black border border-black">
                Kembali ke Form
            </a>
        </div>
    </div>
</body>
</html>

<?php
// Tutup koneksi
$selectdb->close();
?>
