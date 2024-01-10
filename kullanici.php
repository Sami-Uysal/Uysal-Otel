<?php
session_start();
error_reporting(0);

$email = $_SESSION['email'];
$kullaniciadi = $_SESSION['kullaniciadi'];
$avatar = '';
if (isset($_SESSION['kullaniciid'])) {
    $kullaniciid = $_SESSION['kullaniciid'];
    if (isset($_SESSION['avatar'])){ 
    $avatar = $_SESSION['avatar'];
    $avatar = 'dosyalar/' . $avatar;
    }
    else $avatar = 'dosyalar/avatar.png';

    $sunucuadi = "localhost";
    $kadi = "root";
    $sifre = "";
    $vtadi = "uysalotel"; 

    try {
        $conn = new PDO("mysql:host=$sunucuadi;dbname=$vtadi", $kadi, $sifre);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM rezervasyonlar WHERE kullanici_id = :kullaniciid");
        $stmt->bindParam(':kullaniciid', $kullaniciid);
        $stmt->execute();
        $rezervasyonlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uysal Otel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@500;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/kullanici.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$busayfa = 'kullanici';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<div class="container">
    <div class="profile">
        <img src="<?php echo $avatar; ?>" alt="Profil Resmi" class="img-fluid rounded-circle">
        <div>
            <h3><?php echo $kullaniciadi?></h3>
            <p>E-posta: <?php echo $email;?></p>
        </div>
    </div>
    <div class="reservation">
        <h2>Rezervasyonlar</h2>
        <?php
        
        if (!empty($rezervasyonlar)) {
            foreach ($rezervasyonlar as $rezervasyon) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Rezervasyon #' . $rezervasyon['rezervasyon_id'] . '</h5>';
                echo '<p class="card-text">Tarih: ' . $rezervasyon['rezervasyon_tarihi'] . '</p>';
                echo '<p class="card-text">Oda ID: ' . $rezervasyon['oda_id'] . '</p>';
                echo '</div></div>';
            }
        } else {
            echo "Rezervasyon bulunamadı.";
        }
        ?>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>