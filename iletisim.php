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
    <link rel="stylesheet" href="css/iletisim.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$currentPage = 'iletisim';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<div class="container mb-3">
    <div class="row">
        <div class="bg-white shadow rounded">
            <h1 class="text-center mt-5 mb-5 h-font">Bizimle İletişime Geçin</h1>
        </div>
    </div>
</div>

<form action="php/iletisimsql.php" method="post" class="contact-form form">
    <div class="form-group">
        <label for="ad">Adınız:</label><br>
        <input type="text" id="ad" name="ad" required>
    </div>
    <div class="form-group">
        <label for="email">E-posta:</label><br>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="mesaj">Mesajınız:</label><br>
        <textarea id="mesaj" name="mesaj" rows="4" cols="50" required></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Gönder">
    </div>
</form>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/javascript.js"></script>
</html>