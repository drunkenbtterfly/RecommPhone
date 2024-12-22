<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendukung Keputusan Pemilihan Smartphone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: '#da373d', // Warna custom
            },
            fontFamily: {
              roboto: ['Roboto', 'sans-serif'], // Tambahkan font Roboto
            },
          },
        },
      };
    </script>
    <link rel="icon" type="image/png" sizes="96x96" href="assets/image/favicon.png">
</head>
<body class="bg-gray-100 text-gray-800 font-roboto">
    <!-- Body Start -->
    <div class="flex justify-center items-center mt-8">
        <h5 class="text-2xl font-semibold">Cari Spesifikasi Handphone</h5>
    </div>

    <!-- Daftar Smartphone Start -->
    <div class="p-40">
        <div class="container mx-auto px-20">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-center text-xl font-bold mb-6">Masukan Bobot (Spesifikasi yang ingin dicari)</h4>
                <form method="POST" action="hasil.php">
                    <div class="grid grid-cols-2 gap-4 px-40">
                        <!-- Kriteria Harga -->
                        <div class="text-lg font-semibold">Kriteria Harga</div>
                        <div>
                            <select name="harga" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black">
                                <option value="" disabled selected>Kriteria Harga</option>
                                <option value="5">< Rp. 1.000.000</option>
                                <option value="4">1.000.000 - 3.000.000</option>
                                <option value="3">3.000.000 - 4.000.000</option>
                                <option value="2">4.000.000 - 5.000.000</option>
                                <option value="1">> 5.000.000</option>
                            </select>
                        </div>

                        <!-- RAM -->
                        <div class="text-lg font-semibold">RAM</div>
                        <div>
                            <select name="ram" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black">
                                <option value="" disabled selected>Kriteria RAM</option>
                                <option value="1">0 - 1 Gb</option>
                                <option value="2">2 Gb</option>
                                <option value="3">3 Gb</option>
                                <option value="4">4 Gb</option>
                                <option value="5">> 5 Gb</option>
                            </select>
                        </div>

                        <!-- Memori -->
                        <div class="text-lg font-semibold">Memori</div>
                        <div>
                            <select name="memori" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black">
                                <option value="" disabled selected>Kriteria Penyimpanan</option>
                                <option value="1">0 - 4 Gb</option>
                                <option value="2">8 Gb</option>
                                <option value="3">16 Gb</option>
                                <option value="4">32 Gb</option>
                                <option value="5">> 32 Gb</option>
                            </select>
                        </div>

                        <!-- Processor -->
                        <div class="text-lg font-semibold">Processor</div>
                        <div>
                            <select name="processor" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black">
                                <option value="" disabled selected>Kriteria Processor</option>
                                <option value="1">Dualcore</option>
                                <option value="3">Quadcore</option>
                                <option value="5">Octacore</option>
                            </select>
                        </div>

                        <!-- Kamera -->
                        <div class="text-lg font-semibold">Kamera</div>
                        <div>
                            <select name="kamera" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-black">
                                <option value="" disabled selected>Kriteria Kamera</option>
                                <option value="1">0 - 8 Mp</option>
                                <option value="3">8 - 13 Mp</option>
                                <option value="5">>13 Mp</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit" class="bg-black text-white px-6 py-2 rounded shadow hover:bg-white hover:text-black">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>