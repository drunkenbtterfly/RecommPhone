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

// Validasi input
$harga = isset($_POST['harga']) && $_POST['harga'] > 0 ? intval($_POST['harga']) : PHP_INT_MAX;
$ram = isset($_POST['ram']) && $_POST['ram'] > 0 ? intval($_POST['ram']) : 0;
$memori = isset($_POST['memori']) && $_POST['memori'] > 0 ? intval($_POST['memori']) : 0;
$baterai = isset($_POST['baterai']) && $_POST['baterai'] > 0 ? intval($_POST['baterai']) : 0;
$processor = isset($_POST['processor']) && $_POST['processor'] > 0 ? intval($_POST['processor']) : 0;
$kamera = isset($_POST['kamera']) && $_POST['kamera'] > 0 ? intval($_POST['kamera']) : 0;
$jaringan = isset($_POST['jaringan']) && $_POST['jaringan'] > 0 ? intval($_POST['jaringan']) : 0;

// Query untuk mendapatkan rekomendasi handphone menggunakan prepared statement
$stmt = $selectdb->prepare("SELECT * FROM data_hp WHERE 
    harga_angka <= ? AND 
    ram_angka >= ? AND 
    memori_angka >= ? AND 
    baterai_angka >= ? AND 
    processor_angka >= ? AND 
    kamera_angka >= ? AND
    jaringan_angka >= ?");
$stmt->bind_param('iiiiiii', $harga, $ram, $memori, $baterai, $processor, $kamera, $jaringan);
$stmt->execute();
$result = $stmt->get_result();

// Query untuk matriks perhitungan
$matrixQuery = "SELECT id_hp, nama_hp, harga_angka, ram_angka, memori_angka, baterai_angka, processor_angka, kamera_angka, jaringan_angka FROM data_hp";
$matrixResult = $selectdb->query($matrixQuery);

$W1	= $_POST['harga'];
$W2	= $_POST['ram'];
$W3	= $_POST['memori'];
$W4	= $_POST['baterai'];
$W5	= $_POST['kamera'];
$W6	= $_POST['processor'];
$W7	= $_POST['jaringan'];

// Fungsi pembagiNM dengan validasi
function pembagiNM($matrik) {
    if (!is_array($matrik)) {
        return []; // Return array kosong jika $matrik tidak valid
    }

    $pembagi = [];
    $jumlahKolom = sizeof($matrik[0]);

    for ($i = 0; $i < $jumlahKolom; $i++) {
        $pembagi[$i] = 0;
        foreach ($matrik as $baris) {
            $pembagi[$i] += pow($baris[$i], 2);
        }
        $pembagi[$i] = sqrt($pembagi[$i]);
    }

    return $pembagi;
}

// Pastikan $matrik didefinisikan sebelum digunakan
$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
$matrik = []; // Inisialisasi matriks sebagai array kosong

while ($data_hp = mysqli_fetch_array($query)) {
    $matrik[] = [
        $data_hp['harga_angka'],
        $data_hp['ram_angka'],
        $data_hp['memori_angka'],
        $data_hp['baterai_angka'],
        $data_hp['kamera_angka'],
        $data_hp['processor_angka'],
        $data_hp['jaringan_angka']
    ];
}

// Panggil fungsi pembagiNM
$pembagiNM = pembagiNM($matrik);

//Normalisasi
function Transpose($squareArray) {

    if ($squareArray == null) { return null; }
    $rotatedArray = array();
    $r = 0;

    foreach($squareArray as $row) {
        $c = 0;
        if (is_array($row)) {
            foreach($row as $cell) { 
                $rotatedArray[$c][$r] = $cell;
                ++$c;
            }
        }
        else $rotatedArray[$c][$r] = $row;
        ++$r;
    }
    return $rotatedArray;
}

function JarakIplus($aplus,$bob){
	for ($i=0;$i<sizeof($bob);$i++) {
		$dplus[$i] = 0;
		for($j=0;$j<sizeof($aplus);$j++){
			$dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]),2);
		}
		$dplus[$i] = round(sqrt($dplus[$i]),4);
	}
	return $dplus;
}

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
            <div class="bg-white shadow-md rounded-md">
                <button id="accordion-toggle" 
                        class="w-full text-left p-4 text-gray-800 font-medium border-b border-gray-200 focus:outline-none hover:bg-gray-100">
                    Klik untuk melihat matriks
                </button>
                <div id="accordion-content" class="hidden p-4">
                    <!-- Tabel Matrik Perhitungan -->
                    <h2 class="text-center text-xl font-bold my-6">Matriks Smartphone</h2>
                    <?php if ($matrixResult->num_rows > 0): ?>
                        <table class="min-w-full border-collapse border border-gray-200 mb-6">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="text-center px-4 py-2 border border-gray-300">Alternatif</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C1 (Cost)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C2 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C3 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C4 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C5 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C6 (Benefit)</th>
                                    <th class="text-center px-4 py-2 border border-gray-300">C7 (Benefit)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($data_hp = $matrixResult->fetch_assoc()): ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="text-center px-4 py-2 border border-gray-300">A<?= $no++ ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['harga_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['ram_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['memori_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['baterai_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['kamera_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['processor_angka']) ?></td>
                                        <td class="text-center px-4 py-2 border border-gray-300"><?= htmlspecialchars($data_hp['jaringan_angka']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">Tidak ada data dalam tabel matriks.</p>
                    <?php endif; ?>
                    <div class="container mx-auto py-6">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h5 class="text-lg font-bold text-center text-gray-800 mb-4">Matriks Normalisasi "R"</h5>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border border-gray-300 px-4 py-2 text-center">Alternatif</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C1 (Cost)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C2 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C3 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C4 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C5 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C6 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C7 (Benefit)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                        $no = 1;
                                        $pembagiNM = pembagiNM($matrik);
                                        while ($data_hp = mysqli_fetch_array($query)) {

                                            $MatrikNormalisasi[$no - 1] = array(
                                                $data_hp['harga_angka'] / $pembagiNM[0],
                                                $data_hp['ram_angka'] / $pembagiNM[1],
                                                $data_hp['memori_angka'] / $pembagiNM[2],
                                                $data_hp['baterai_angka'] / $pembagiNM[3],
                                                $data_hp['kamera_angka'] / $pembagiNM[4],
                                                $data_hp['processor_angka'] / $pembagiNM[5],
                                                $data_hp['jaringan_angka'] / $pembagiNM[6]
                                            );
                                            ?>
                                            <tr class="hover:bg-gray-50">
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo "A", $no ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['harga_angka'] / $pembagiNM[0], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['ram_angka'] / $pembagiNM[1], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['memori_angka'] / $pembagiNM[2], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['baterai_angka'] / $pembagiNM[3], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['kamera_angka'] / $pembagiNM[4], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['processor_angka'] / $pembagiNM[5], 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($data_hp['jaringan_angka'] / $pembagiNM[6], 6) ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container mx-auto py-6">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h5 class="text-lg font-bold text-center text-gray-800 mb-4">BOBOT (W)</h5>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Harga</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Ram</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Memori</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Baterai</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Kamera</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Processor</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Value Kriteria Jaringan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="hover:bg-gray-50">
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W1); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W2); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W3); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W4); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W5); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W6); ?>
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2 text-center">
                                                <?php echo($W7); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container mx-auto py-6">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h5 class="text-lg font-bold text-center text-gray-800 mb-4">Matriks Normalisasi terBobot "Y"</h5>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse border border-gray-300">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="border border-gray-300 px-4 py-2 text-center">Alternatif</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C1 (Cost)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C2 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C3 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C4 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C5 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C6 (Benefit)</th>
                                            <th class="border border-gray-300 px-4 py-2 text-center">C7 (Benefit)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                        $no = 1;
                                        $pembagiNM = pembagiNM($matrik);
                                        while ($data_hp = mysqli_fetch_array($query)) {
                                            $NormalisasiBobot[$no - 1] = array(
                                                $MatrikNormalisasi[$no - 1][0] * $W1,
                                                $MatrikNormalisasi[$no - 1][1] * $W2,
                                                $MatrikNormalisasi[$no - 1][2] * $W3,
                                                $MatrikNormalisasi[$no - 1][3] * $W4,
                                                $MatrikNormalisasi[$no - 1][4] * $W5,
                                                $MatrikNormalisasi[$no - 1][5] * $W6,
                                                $MatrikNormalisasi[$no - 1][6] * $W7
                                            );
                                        ?>
                                            <tr class="hover:bg-gray-50">
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo "A", $no ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][0] * $W1, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][1] * $W2, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][2] * $W3, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][3] * $W4, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][4] * $W5, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][5] * $W6, 6) ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                    <?php echo round($MatrikNormalisasi[$no - 1][6] * $W7, 6) ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-6">
                        <h4 class="text-xl font-bold text-gray-700">Matrik Solusi Ideal Positif dan Negatif</h4>
                    </div>
                    <ul class="list-none">
                        <li>
                            <div class="flex justify-center">
                                <div class="w-full max-w-4xl bg-white shadow-md rounded-lg overflow-hidden">
                                    <div class="p-6">
                                        <div class="overflow-x-auto">
                                            <table class="table-auto w-full border-collapse border border-gray-200">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">&nbsp;</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y1 (Cost)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y2 (Benefit)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y3 (Benefit)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y4 (Benefit)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y5 (Benefit)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y6 (Benefit)</th>
                                                        <th class="border border-gray-300 px-4 py-2 text-center">Y7 (Benefit)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $NormalisasiBobotTrans = Transpose($NormalisasiBobot);
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        $idealpositif = array(
                                                            min($NormalisasiBobotTrans[0]),
                                                            max($NormalisasiBobotTrans[1]),
                                                            max($NormalisasiBobotTrans[2]),
                                                            max($NormalisasiBobotTrans[3]),
                                                            max($NormalisasiBobotTrans[4]),
                                                            max($NormalisasiBobotTrans[5]),
                                                            max($NormalisasiBobotTrans[6])
                                                        );
                                                        ?>
                                                        <td class="border border-gray-300 px-4 py-2 text-center font-semibold">Y+</td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[0]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[1]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[2]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[3]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[4]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[5]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[6]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $idealnegatif = array(
                                                            max($NormalisasiBobotTrans[0]),
                                                            min($NormalisasiBobotTrans[1]),
                                                            min($NormalisasiBobotTrans[2]),
                                                            min($NormalisasiBobotTrans[3]),
                                                            min($NormalisasiBobotTrans[4]),
                                                            min($NormalisasiBobotTrans[5]),
                                                            min($NormalisasiBobotTrans[6])
                                                        );
                                                        ?>
                                                        <td class="border border-gray-300 px-4 py-2 text-center font-semibold">Y-</td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(max($NormalisasiBobotTrans[0]), 6)); ?>&nbsp;(max)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[1]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[2]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[3]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[4]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[5]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                                            <?php echo(round(min($NormalisasiBobotTrans[6]), 6)); ?>&nbsp;(min)
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-4">
                            Jarak antara nilai terbobot setiap alternatif terhadap solusi ideal positif
                        </h4>
                    </div>
                    <ul>
                        <li>
                            <div class="flex justify-center">
                                <div class="w-full max-w-4xl bg-white shadow-md rounded-lg">
                                    <div class="p-4">
                                        <table class="min-w-full border border-gray-200 rounded-md text-sm text-gray-600">
                                            <thead>
                                                <tr class="bg-gray-100 border-b border-gray-300">
                                                    <th class="px-4 py-2 text-center">D+</th>
                                                    <th class="px-4 py-2 text-center"></th>
                                                    <th class="px-4 py-2 text-center">D-</th>
                                                    <th class="px-4 py-2 text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                                $no = 1;
                                                $Dplus = JarakIplus($idealpositif, $NormalisasiBobot);
                                                $Dmin = JarakIplus($idealnegatif, $NormalisasiBobot);
                                                while ($data_hp = mysqli_fetch_array($query)) {
                                                ?>
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2 text-center font-medium text-gray-800"><?php echo "D", $no ?></td>
                                                        <td class="px-4 py-2 text-center"><?php echo round($Dplus[$no - 1], 6) ?></td>
                                                        <td class="px-4 py-2 text-center font-medium text-gray-800"><?php echo "D", $no ?></td>
                                                        <td class="px-4 py-2 text-center"><?php echo round($Dmin[$no - 1], 6) ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-4">
                            Nilai Preferensi untuk Setiap Alternatif (V)
                        </h4>
                    </div>
                    <ul>
                        <li>
                            <div class="flex justify-center">
                                <div class="w-full max-w-4xl bg-white shadow-md rounded-lg">
                                    <div class="p-4">
                                        <table class="min-w-full border border-gray-200 rounded-md text-sm text-gray-600">
                                            <thead>
                                                <tr class="bg-gray-100 border-b border-gray-300">
                                                    <th class="px-4 py-2 text-center">Nilai Preferensi "V"</th>
                                                    <th class="px-4 py-2 text-center">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($selectdb, "SELECT * FROM data_hp");
                                                $no = 1;
                                                $nilaiV = array();
                                                while ($data_hp = mysqli_fetch_array($query)) {
                                                    array_push($nilaiV, $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]));
                                                ?>
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2 text-center font-medium text-gray-800"><?php echo "V", $no ?></td>
                                                        <td class="px-4 py-2 text-center"><?php echo $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]); ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-700 mt-6 mb-4">
                            Nilai Preferensi Tertinggi
                        </h4>
                    </div>
                    <ul>
                        <li>
                            <div class="flex justify-center">
                                <div class="w-full max-w-4xl bg-white shadow-md rounded-lg">
                                    <div class="p-4">
                                        <table class="min-w-full border border-gray-200 text-sm text-gray-600">
                                            <thead>
                                                <tr class="bg-gray-100 border-b border-gray-300">
                                                    <th class="px-4 py-2 text-center">Nilai Preferensi Tertinggi</th>
                                                    <th class="px-4 py-2"></th>
                                                    <th class="px-4 py-2 text-center">Alternatif HP Terpilih</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border-b">
                                                    <?php
                                                    $testmax = max($nilaiV);
                                                    for ($i = 0; $i < count($nilaiV); $i++) {
                                                        if ($nilaiV[$i] == $testmax) {
                                                            $query = mysqli_query($selectdb, "SELECT * FROM data_hp where id_hp = $i+1");
                                                    ?>
                                                            <td class="px-4 py-2 text-center font-medium text-gray-800"><?php echo "V" . ($i + 1); ?></td>
                                                            <td class="px-4 py-2 text-center"><?php echo $nilaiV[$i]; ?></td>
                                                            <?php while ($user = mysqli_fetch_array($query)) { ?>
                                                                <td class="px-4 py-2 text-center"><?php echo $user['nama_hp']; ?></td>
                                                            <?php } ?>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
        const toggleButton = document.getElementById('accordion-toggle');
        const content = document.getElementById('accordion-content');

        toggleButton.addEventListener('click', () => {
            content.classList.toggle('hidden');
            content.classList.toggle('block');
        });
    </script>
</body>
</html>

<?php
// Tutup koneksi
$selectdb->close();
?>
