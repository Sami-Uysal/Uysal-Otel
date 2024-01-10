<?php
require_once('php/baglanti.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $oda_id = $_GET['id'];

    $sql = "SELECT * FROM odalar WHERE oda_id = :oda_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oda_id', $oda_id);
    $stmt->execute();

    $odadetaylari = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$busayfa = 'odaduzenle';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->


<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1>Oda Düzenleme</h1>
            <form id="OdaForm" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="oda_adi" class="form-label">Oda Adı</label>
                    <input type="text" class="form-control" name="oda_adi" value="<?php echo $odadetaylari['oda_adi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="oda_aciklamasi" class="form-label">Oda Açıklaması</label>
                    <textarea class="form-control" rows="3" name="oda_aciklamasi" required><?php echo $odadetaylari['oda_aciklamasi']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="oda_fiyat" class="form-label">Gecelik Fiyat</label>
                    <input type="number" class="form-control" name="oda_fiyat" value="<?php echo $odadetaylari['oda_fiyat']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="oda_tipi" class="form-label">Oda Tipi</label>
                    <input type="text" class="form-control" name="oda_tipi" value="<?php echo $odadetaylari['oda_tipi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="oda_kapasitesi" class="form-label">Oda Kapasitesi</label>
                    <input type="number" class="form-control" name="oda_kapasitesi" value="<?php echo $odadetaylari['oda_kapasitesi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="oda_resim" class="form-label">Oda Resmi</label>
                    <input type="file" class="form-control" name="oda_resim" accept="image/*">
                </div>
                <input type="hidden" name="oda_id" value="<?php echo $odadetaylari['oda_id']; ?>">
                <button type="submit" form="OdaForm" class="btn btn-primary" name="duzenle">Odayı Kaydet</button>
            </form>
        </div>
    </div>
</div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['duzenle'])) {
    $odaAdi = $_POST['oda_adi'];
    $odaAciklamasi = $_POST['oda_aciklamasi'];
    $odaFiyat = $_POST['oda_fiyat'];
    $odaTipi = $_POST['oda_tipi'];
    $odaKapasitesi = $_POST['oda_kapasitesi'];
    $oda_id = $_POST['oda_id']; 

    $dosyaAdi = uniqid() . "_" . $_FILES["oda_resim"]["name"];
    move_uploaded_file($_FILES["oda_resim"]["tmp_name"], "images/rooms/" . $dosyaAdi);

    $sql = "UPDATE odalar 
            SET oda_adi = :oda_adi, oda_aciklamasi = :oda_aciklamasi, oda_fiyat = :oda_fiyat, oda_tipi = :oda_tipi, oda_kapasitesi = :oda_kapasitesi, oda_resim = :oda_resim 
            WHERE oda_id = :oda_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oda_adi', $odaAdi);
    $stmt->bindParam(':oda_aciklamasi', $odaAciklamasi);
    $stmt->bindParam(':oda_fiyat', $odaFiyat);
    $stmt->bindParam(':oda_tipi', $odaTipi);
    $stmt->bindParam(':oda_kapasitesi', $odaKapasitesi);
    $stmt->bindParam(':oda_id', $oda_id);
    $stmt->bindParam(':oda_resim', $dosyaAdi);

    if ($stmt->execute()) {
        echo "<script>alert('Oda başarıyla güncellendi.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Güncelleme sırasında bir hata oluştu.'); window.location.href = 'admin.php';</script>";
    }
}
?>


