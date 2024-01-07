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
$currentPage = 'odalar';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<div class="container mb-3">
    <div class="row">
        <div class="bg-white shadow rounded">
            <h1 class="text-center mt-5 mb-5 ">Odalar</h1>
        </div>
    </div>
</div>

<!-- Odalar Başlangıç -->
<main style="margin: 0;">
  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 1">
    <h2>Oda 1</h2>
    <p class="description">Rahat ve ferah bir oda.</p>
    <p class="price">Gecelik fiyat: $100</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 2">
    <h2>Oda 2</h2>
    <p class="description">Manzaralı bir oda.</p>
    <p class="price">Gecelik fiyat: $150</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 1">
    <h2>Oda 1</h2>
    <p class="description">Rahat ve ferah bir oda.</p>
    <p class="price">Gecelik fiyat: $100</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 2">
    <h2>Oda 2</h2>
    <p class="description">Manzaralı bir oda.</p>
    <p class="price">Gecelik fiyat: $150</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 1">
    <h2>Oda 1</h2>
    <p class="description">Rahat ve ferah bir oda.</p>
    <p class="price">Gecelik fiyat: $100</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

  <section class="room col-lg-3 mb-3">
    <img src="images/rooms/delux.png" alt="Oda 2">
    <h2>Oda 2</h2>
    <p class="description">Manzaralı bir oda.</p>
    <p class="price">Gecelik fiyat: $150</p>
    <button class="book-btn">Rezervasyon Yap</button>
  </section>

</main>
     
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</html>
    