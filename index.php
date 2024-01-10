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
error_reporting(0);
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
            <form method="POST" action="">
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
                        <input type="submit" class="btn btn-dark text-white shadow-none" value="Ara">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Oda Arama Bitiş  -->

<div class="row mt-4 justify-content-center">
        <?php include 'php/odaarama.php'; ?>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/javascript.js"></script>
</html>