<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uysal Otel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@500;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/odalar.css">     

</head>
    
<body>

<!-- Navbar  Başlangıç -->
<?php
$busayfa = 'odalar';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<!-- Bağlantı -->
<?php
$sunucuadi = "localhost";
$kadi = "root";
$sifre = "";
$vtadi = "uysalotel"; 

try {
    $conn = new PDO("mysql:host=$sunucuadi;dbname=$vtadi", $kadi, $sifre);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM odalar");
    $stmt->execute();
    $odalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
<!-- Bağlantı Bitiş -->

<div class="container mb-3">
    <div class="row">
        <div class="bg-white shadow rounded">
            <h1 class="text-center mt-5 mb-5 ">Odalar</h1>
        </div>
    </div>
</div>

<!-- Odalar Listesi -->
<main class="container-fluid">
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        if (!empty($odalar)) {
            foreach ($odalar as $oda) {
                echo "<div class='col'>";
                echo "<div class='h-100 room mb-3 mx-5'>";
                echo "<img src='images/rooms/{$oda['oda_resim']}' class='card-img-top' alt='{$oda['oda_adi']}'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$oda['oda_adi']}</h5>";
                echo "<p class='card-text'>{$oda['oda_aciklamasi']}</p>";
                echo "<p class='card-text' style='font-weight: bold;'>Gecelik fiyat: {$oda['oda_fiyat']}</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Odalar bulunamadı.</p>";
        }
        ?>
    </div>
</main>
<!-- Odalar Listesi Bitiş -->
     
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</html>
    