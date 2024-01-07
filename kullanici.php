<?php

$avatar;
if (isset($_SESSION['avatar'])) {
    $avatar = $_SESSION['avatar'];
    $avatar = 'dosyalar/' . $avatar;

} else {
    $avatar = 'dosyalar/avatar.png';
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
    <link rel="stylesheet" href="css/iletisim.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$currentPage = 'kullanici';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <img src="<?php echo $avatar; ?>" alt="Profil Resmi" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-9">
                <h1>Kullanıcı Adı</h1>
                <p>E-posta: kullanici@example.com</p>
                <!-- Buraya kullanıcı bilgilerini göstermek için gerekli HTML ve PHP kodlarını ekleyebilirsin -->
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>