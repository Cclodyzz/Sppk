<?php
session_start();
require 'config/config.php';
require 'classes/Penyiar.php';
require 'classes/Penilaian.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$penyiarModel = new Penyiar($conn);
$penyiarList = $penyiarModel->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $penyiar_id = $_POST['penyiar_id'];
    $user_id = $_SESSION['user']['id'];
    $kualitas_suara = $_POST['kualitas_suara'];
    $keterampilan_komunikasi = $_POST['keterampilan_komunikasi'];
    $penguasaan_materi = $_POST['penguasaan_materi'];
    $kreatifitas = $_POST['kreatifitas'];
    $engagement = $_POST['engagement'];
    $tanggal = date('Y-m-d');

    $penilaianModel = new Penilaian($conn);
    $penilaianModel->create($penyiar_id, $user_id, $kualitas_suara, $keterampilan_komunikasi, $penguasaan_materi, $kreatifitas, $engagement, $tanggal);

    echo "<p>Penilaian berhasil diberikan!</p>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Penilaian Penyiar</title>
</head>

<body>
    <h2>Berikan Penilaian</h2>
    <form method="POST">
        <select name="penyiar_id" required>
            <option value="">Pilih Penyiar</option>
            <?php foreach ($penyiarList as $penyiar): ?>
                <option value="<?php echo $penyiar['id']; ?>"><?php echo $penyiar['nama']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Kualitas Suara:</label>
        <input type="number" name="kualitas_suara" min="1" max="5" required><br>

        <label>Keterampilan Komunikasi:</label>
        <input type="number" name="keterampilan_komunikasi" min="1" max="5" required><br>

        <label>Penguasaan Materi:</label>
        <input type="number" name="penguasaan_materi" min="1" max="5" required><br>

        <label>Kreatifitas:</label>
        <input type="number" name="kreatifitas" min="1" max="5" required><br>

        <label>Engagement:</label>
        <input type="number" name="engagement" min="1" max="5" required><br>

        <button type="submit">Kirim Penilaian</button>
    </form>
</body>

</html>