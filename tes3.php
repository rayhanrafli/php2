<?php
function beratBadanIdeal($tinggi, $gender) {
    
    $ideal = $tinggi - 100;

    return ($gender == 'pria') 
        ? $ideal - ($ideal * 0.10) 
        : $ideal + ($ideal * 0.15); 
}

$bbi = null; 
$beratAsli = null; 
$pesan = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = ($_POST['nama']);
    $tinggi = (int)($_POST['tinggi']);
    $gender = ($_POST['gender']);
    $beratAsli = (float)($_POST['berat_asli']);

    $bbi = beratBadanIdeal($tinggi, $gender);

    if ($beratAsli < $bbi) {
        $pesan = "Makan lebih banyak.";
    } elseif ($beratAsli == $bbi) {
        $pesan = "Berat anda sehat.";
    } else {
        $pesan = "Lebih banyak olahraga.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hitung Berat Badan Ideal</title>
</head>
<body>
    <h1>Program Berat Badan Ideal</h1>
    <form method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>
        
        <label for="tinggi">Tinggi Badan (cm):</label>
        <input type="number" id="tinggi" name="tinggi" required><br><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select><br><br>
        
        <label for="berat_asli">Berat Badan Asli (kg):</label>
        <input type="number" id="berat_asli" name="berat_asli" step="0.01" required><br><br>
        
        <input type="submit" value="Hitung">
    </form>

    <?php if ($bbi !== null): ?>
        <h2>Hasil:</h2>
        <p>Nama: <?php echo $nama; ?></p>
        <p>Tinggi Badan: <?php echo $tinggi; ?> cm</p>
        <p>Gender: <?php echo $gender; ?></p>
        <p>Berat Badan Ideal: <?php echo number_format($bbi, 2, ',', '.'); ?> kg</p>
        <p>Berat Badan Asli: <?php echo number_format($beratAsli, 2, ',', '.'); ?> kg</p>
        <p><?php echo $pesan; ?></p>
    <?php endif; ?>
</body>
</html>