<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hp";

$selectdb = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($selectdb->connect_error) {
    die("Connection failed: " . $selectdb->connect_error);
}

// Aktifkan mode error reporting untuk mysqli
$selectdb->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

// Ambil data dari form dengan validasi
$harga = isset($_POST['harga']) ? intval($_POST['harga']) : 0;
$ram = isset($_POST['ram']) ? intval($_POST['ram']) : 0;
$memori = isset($_POST['memori']) ? intval($_POST['memori']) : 0;
$baterai = isset($_POST['baterai']) ? intval($_POST['baterai']) : 0;
$processor = isset($_POST['processor']) ? intval($_POST['processor']) : 0;
$kamera = isset($_POST['kamera']) ? intval($_POST['kamera']) : 0;
$jaringan = isset($_POST['jaringan']) ? intval($_POST['jaringan']) : 0;

// Query untuk mendapatkan rekomendasi handphone menggunakan prepared statement
$stmt = $selectdb->prepare("
    SELECT * FROM data_hp WHERE 
        harga_angka >= ? AND 
        ram_angka >= ? AND 
        memori_angka >= ? AND 
        baterai_angka >= ? AND 
        processor_angka >= ? AND 
        kamera_angka >= ? AND
        jaringan_angka >= ?
    ORDER BY harga_angka DESC, ram_angka DESC, memori_angka DESC, processor_angka DESC, kamera_angka DESC
");
$stmt->bind_param('iiiiiii', $harga, $ram, $memori, $baterai, $processor, $kamera, $jaringan);
$stmt->execute();
$result = $stmt->get_result();

// Query untuk matriks perhitungan
$matrixQuery = "SELECT id_hp, nama_hp, harga_angka, ram_angka, memori_angka, baterai_angka, processor_angka, kamera_angka, jaringan_hp FROM data_hp";
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
                        <th class="border border-gray-300 px-4 py-2">Baterai</th>
                        <th class="border border-gray-300 px-4 py-2">Kamera</th>
                        <th class="border border-gray-300 px-4 py-2">Processor</th>
                        <th class="border border-gray-300 px-4 py-2">Jaringan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['nama_hp']) ?></td>
                            <td class="border border-gray-300 px-4 py-2">Rp <?= number_format($row['harga_hp'], 0, ',', '.') ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['ram_hp']) ?> GB</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['memori_hp']) ?> GB</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['baterai_hp']) ?> mAh</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['kamera_hp']) ?> MP</td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['processor_hp']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['jaringan_hp']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-lg">Tidak ada data yang sesuai dengan kriteria.</p>
        <?php endif; ?>

        <div class="w-full max-w-4xl mx-auto">
            <h2 class="text-center text-xl font-bold mt-10 mb-6">Matriks Perhitungan</h2>
            <div class="bg-white shadow-md rounded-md">
                <button id="accordion-toggle" 
                        class="w-full text-left p-4 text-gray-800 font-medium border-b border-gray-200 focus:outline-none hover:bg-gray-100">
                    Klik untuk melihat tabel
                </button>
                <div id="accordion-content" class="hidden p-4">
                    <?php if ($matrixResult->num_rows > 0): ?>
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="text-center px-4 py-2 border border-gray-300">Alternatif</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C1 (Cost)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C2 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C3 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C4 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C5 (Benefit)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($data_hp = $matrixResult->fetch_assoc()): ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= "A" . $no++; ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['harga_angka']); ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['ram_angka']); ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['memori_angka']); ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['processor_angka']); ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['kamera_angka']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="index.php" class="bg-black text-white px-6 py-2 rounded shadow hover:bg-white hover:text-black border border-black">
                Kembali ke Form
            </a>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('accordion-toggle');
        const content = document.getElementById('accordion-content');

        toggle.addEventListener('click', () => {
            content.classList.toggle('hidden');
        });
    </script>
</body>
</html>

<?php
// Tutup koneksi
$selectdb->close();
?>
