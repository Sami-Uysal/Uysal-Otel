<?php
require_once('php/baglanti.php');
session_start();
if (isset($_SESSION['kullaniciid'])) {
    $kullaniciid = $_SESSION['kullaniciid'];
}
error_reporting(0);
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$busayfa= 'index';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<!-- Carousel Başlangıç -->
<div onclick="nextSlide()" class="slideshow-container px-lg-4 mt-4 mb-3">

    <?php
    $roomImages = array("room1.png", "room2.png", "room3.png", "room4.png", "room5.png", "room6.png", "room7.png");

    foreach ($roomImages as $image) {
        echo '<div class="mySlides">';
        echo '<img src="images/slider/' . $image . '" class="w-100 d-block">';
        echo '</div>';
    }
    ?>

</div>
<!-- Carousel Bitiş -->


<!-- Oda Arama Başlangıç  -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="modal-title mb-4 d-flex align-items-center">
                <i class="bi bi-ticket-fill fs-1 me-2"></i> Bilet Alma
            </h5>
            <form method="POST" action="" id="form">
                <div class="row align-items-end">

                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Başlangıç</label>
                        <input type="date" class="form-control shadow-none" name="baslangic_tarihi">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Bitiş</label>
                        <input type="date" class="form-control shadow-none" name="bitis_tarihi">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Yetişkin</label>
                        <select class="form-select shadow-none" name="yetiskin">
                            <option value="1">1 Yetişkin</option>
                            <option value="2">2 Yetişkin</option>
                            <option value="3">3 Yetişkin</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Çocuk</label>
                        <select class="form-select shadow-none" name="cocuk">
                            <option value="1">1 Çocuk</option>
                            <option value="2">2 Çocuk</option>
                            <option value="3">3 Çocuk</option>
                        </select>
                    </div>
                    <div class="col-lg-1 mt-2 mb-lg-3">
                        <input type="submit" class="btn btn-dark text-white shadow-none" name="ara" value="Ara">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Oda Arama Bitiş  -->

<!-- Oda Listesi Başlangıç  -->
<div class="row mt-4 justify-content-center">
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ara'])) {

            $baslangic_tarihi = date("Y-m-d", strtotime($_POST['baslangic_tarihi']));
            $bitis_tarihi = date("Y-m-d", strtotime($_POST['bitis_tarihi']));

            try {
                if ($conn) {
  
                    $sql = "SELECT oda_id, oda_resim, oda_adi FROM odalar WHERE oda_id NOT IN (
                            SELECT DISTINCT oda_id FROM rezervasyonlar 
                            WHERE (baslangic_tarihi BETWEEN :baslangic_tarihi_param AND :bitis_tarihi_param)
                            OR (bitis_tarihi BETWEEN :baslangic_tarihi_param AND :bitis_tarihi_param)
                            OR (baslangic_tarihi < :baslangic_tarihi_param AND bitis_tarihi > :bitis_tarihi_param)
                        )";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':baslangic_tarihi_param', $baslangic_tarihi);
                    $stmt->bindParam(':bitis_tarihi_param', $bitis_tarihi);

                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="col-lg-4 mb-3">';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<img src="../Project/images/rooms/' . $row["oda_resim"] . '" alt="' . $row["oda_adi"] . '" class="card-img-top">';
                            echo "<h5 class='card-text'>" . $row["oda_adi"] . "</h5>";

                            echo '<form method="POST" action="">';
                            echo '<input type="hidden" name="oda_id" value="' . $row["oda_id"] . '">';
                            echo '<input type="hidden" name="kullanici_id" value="' . $kullaniciid . '">';
                            echo '<input type="hidden" name="baslangic_tarihi" value="' . $baslangic_tarihi . '">';
                            echo '<input type="hidden" name="bitis_tarihi" value="' . $bitis_tarihi . '">';
                            echo '<button type="submit" class="btn btn-primary" name="ekle">Bu Odayı Seç</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-lg-12">';
                        echo '<p>Uygun oda bulunamadı.</p>';
                        echo '</div>';
                    }

                    $conn = null;
                } else {
                    echo "<script>alert('Bağlantı hatası.')</script>";
                    echo '<script>window.location.replace("index.php");</script>';
                }
            } catch (PDOException $e) {
                echo "Bağlantı Hatası: " . $e->getMessage();
            }
        }
        ?>
</div>
<!-- Oda Listesi Bitiş  -->

<!-- Rezervasyon Oluştur Başlangıç  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ekle'])) {
    $oda_id = $_POST['oda_id'];
    $kullanici_id = $_POST['kullanici_id'];
    $baslangic_tarihi = $_POST['baslangic_tarihi'];
    $bitis_tarihi = $_POST['bitis_tarihi'];

    try {
        $sql = "INSERT INTO rezervasyonlar (oda_id, kullanici_id, baslangic_tarihi, bitis_tarihi) VALUES (:oda_id, :kullanici_id, :baslangic_tarihi, :bitis_tarihi)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':oda_id', $oda_id);
        $stmt->bindParam(':kullanici_id', $kullanici_id);
        $stmt->bindParam(':baslangic_tarihi', $baslangic_tarihi);
        $stmt->bindParam(':bitis_tarihi', $bitis_tarihi);

        if ($stmt->execute()) {
            echo "<script>alert('Yeni rezervasyon oluşturuldu.'); window.location.href = 'kullanici.php';</script>";
        } else {
            echo "<script>alert('Veritabanına eklerken bir hata oluştu.')</script>";
        }
    } catch (PDOException $e) {
        echo "Bağlantı Hatası: " . $e->getMessage();
    }
}
?>
<!-- Rezervasyon Oluştur Bitiş  -->


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form');
        form.addEventListener('submit', function(event) {
            const baslangicTarih = document.querySelector('input[name="baslangic_tarihi"]').value;
            const bitisTarih = document.querySelector('input[name="bitis_tarihi"]').value;

            if (baslangicTarih === '' || bitisTarih === '') {
                event.preventDefault();
                alert('Lütfen başlangıç ve bitiş tarihini seçiniz.');
                location.reload();
            }
        });
    });
</script>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/javascript.js"></script>
</html>