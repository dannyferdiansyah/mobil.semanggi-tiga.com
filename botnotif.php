<?php

// Kredensial Database
$dbHost     = "localhost";
$dbUsername = "semangg3_hr";
$dbPassword = "semanggitigajaya321";
$dbName     = "semangg3_abujapi";

// Koneksi ke Database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kredensial Bot Telegram
$token = "7207584396:AAEAqhokz1HpV8McDgXHUmQWqw6WhqoWgB8";
$apiURL = "https://api.telegram.org/bot$token/sendMessage?chat_id=";

// Dapatkan semua event yang belum dinotifikasi dan tanggal eventnya hari ini atau sebelumnya
$sqlEvents = "
    SELECT *
    FROM bujplokal
    WHERE tanggal_notif= CURDATE()

    UNION

    SELECT *
    FROM bujpperwakilan
    WHERE tanggal_notif = CURDATE()
";
$resultEvents = $conn->query($sqlEvents);

if ($resultEvents->num_rows > 0) {
    // Dapatkan semua ID chat Telegram dari tabel users
    $sqlUsers = "SELECT * FROM user";
    $resultUsers = $conn->query($sqlUsers);
    $chatIds = array();

    if ($resultUsers->num_rows > 0) {
        while ($rowUser = $resultUsers->fetch_assoc()) {
            $chatIds[] = $rowUser['id_tele'];
        }
    }

    while($rowEvent = $resultEvents->fetch_assoc()) {
        $msg = urlencode("Pengingat: Bahwa Kantor " . $rowEvent["bujp_pusat"] . ", No STA ". $rowEvent["no_sta"] ." 10 Hari Lagi Masa Expired " . $rowEvent["tanggal_expired"]."<br>Hubungi Penanggung Jawab Atas Nama ".$rowEvent['penanggung_jawab'].", Bisa Chat https://wa.me/".$rowEvent["telepon_pj"]);
        
        foreach ($chatIds as $chatId) {
            file_get_contents($apiURL . $chatId . "&text=" . $msg);
        }    
    }

} else {
    echo "Tidak ada notifikasi yang perlu dikirim.";
}

$conn->close();

?>