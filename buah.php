<?php
function hitungTotalPembelanjaan($buah, $sayur, $gula) {
    if ($buah < 0 || $sayur < 0 || $gula < 0) {
        return "Harga tidak boleh negatif.";
    }

    $total = $buah + $sayur + $gula;
    $diskon = 15; // Diskon tetap 15%
    $jumlahDiskon = $total * ($diskon / 100);
    $totalAkhir = $total - $jumlahDiskon;

    return [
        'total' => $total,
        'jumlahDiskon' => $jumlahDiskon,
        'totalAkhir' => $totalAkhir,
        'diskon' => $diskon
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hargaBuah = isset($_POST['hargaBuah']) ? floatval($_POST['hargaBuah']) : 0;
    $hargaSayur = isset($_POST['hargaSayur']) ? floatval($_POST['hargaSayur']) : 0;
    $hargaGula = isset($_POST['hargaGula']) ? floatval($_POST['hargaGula']) : 0;

    $result = hitungTotalPembelanjaan($hargaBuah, $hargaSayur, $hargaGula);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Belanjaan</title>
</head>
<body>
    <h1>Form Belanjaan</h1>
    <form method="POST">
        <label for="hargaBuah">Harga Buah (Rp):</label>
        <input type="number" id="hargaBuah" name="hargaBuah" required><br><br>

        <label for="hargaSayur">Harga Sayur (Rp):</label>
        <input type="number" id="hargaSayur" name="hargaSayur" required><br><br>

        <label for="hargaGula">Harga Gula (Rp):</label>
        <input type="number" id="hargaGula" name="hargaGula" required><br><br>

        <input type="submit" value="Hitung">
    </form>

    <?php if (isset($result)): ?>
        <h2>Rincian Pembelanjaan</h2>
        <p>Harga Buah: Rp <?php echo number_format($hargaBuah, 0, ',', '.'); ?></p>
        <p>Harga Sayur: Rp <?php echo number_format($hargaSayur, 0, ',', '.'); ?></p>
        <p>Harga Gula: Rp <?php echo number_format($hargaGula, 0, ',', '.'); ?></p>
        
        <h2>Total Sebelum Diskon: Rp <?php echo number_format($result['total'], 0, ',', '.'); ?></h2>
        <h2>Diskon (15%): Rp <?php echo number_format($result['jumlahDiskon'], 0, ',', '.'); ?></h2>
        <h2>Total Setelah Diskon: Rp <?php echo number_format($result['totalAkhir'], 0, ',', '.'); ?></h2>

        <?php if ($result['totalAkhir'] > 75000): ?>
            <h3>Selamat! Anda mendapatkan piring cantik!</h3>
        <?php else: ?>
            <h3>Terima kasih atas belanja Anda!</h3>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
