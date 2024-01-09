<?php
    require_once('php/baglanti.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $rezervasyon_id = $_GET['id'];

        $sql = "SELECT r.rezervasyon_id, o.oda_adi, u.ad, r.baslangic_tarihi, r.bitis_tarihi
                FROM rezervasyonlar r 
                INNER JOIN odalar o ON r.oda_id = o.oda_id
                INNER JOIN kullanicilar u ON r.kullanici_id = u.id
                WHERE r.rezervasyon_id = :rezervasyon_id";
                
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rezervasyon_id', $rezervasyon_id);
        $stmt->execute();

        $rezervasyon = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$currentPage = 'rezervasyonduzenle';
include 'php/navbar.php'; 
?>
<!-- Navbar  Bitiş -->

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1>Rezervasyonu Düzenle</h1>
            <form id="form" action="" method="POST">
                <div class="mb-3">
                    <label for="oda_adi" class="form-label">Oda Adı</label>
                    <select class="form-select" id="oda_adi" name="oda_adi" required>
                        <option value="<?php echo $oda_id; ?>"><?php echo $rezervasyon['oda_adi']; ?></option>
                        <?php
                        $odalar = $conn->query("SELECT oda_id, oda_adi FROM odalar");
                        while ($oda = $odalar->fetch(PDO::FETCH_ASSOC)) {
                            if ($oda['oda_id'] != $oda_id) {
                                echo "<option value='" . $oda["oda_id"] . "'>" . $oda["oda_adi"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kullanici_ad" class="form-label">Kullanıcı Adı</label>
                    <select class="form-select" id="kullanici_ad" name="kullanici_ad" required>
                        <option value="<?php echo $kullanici_id; ?>"><?php echo $rezervasyon['ad']; ?></option>
                        <?php
                        $kullanicilar = $conn->query("SELECT id, ad FROM kullanicilar");
                        while ($kullanici = $kullanicilar->fetch(PDO::FETCH_ASSOC)) {
                            if ($kullanici['id'] != $kullanici_id) {
                                echo "<option value='" . $kullanici["id"] . "'>" . $kullanici["ad"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                    <input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" value="<?php echo $rezervasyon['baslangic_tarihi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                    <input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi" value="<?php echo $rezervasyon['bitis_tarihi']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="duzenle">Rezervasyonu Kaydet</button>
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['duzenle'])) {
    $oda_id = $_POST['oda_adi'];
    $kullanici_id = $_POST['kullanici_ad'];
    $baslangic_tarihi = $_POST['baslangic_tarihi'];
    $bitis_tarihi = $_POST['bitis_tarihi'];

    $sql = "UPDATE rezervasyonlar 
            SET oda_id = :oda_id, kullanici_id = :kullanici_id, baslangic_tarihi = :baslangic_tarihi, bitis_tarihi = :bitis_tarihi 
            WHERE rezervasyon_id = :rezervasyon_id";
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oda_id', $oda_id);
    $stmt->bindParam(':kullanici_id', $kullanici_id);
    $stmt->bindParam(':baslangic_tarihi', $baslangic_tarihi);
    $stmt->bindParam(':bitis_tarihi', $bitis_tarihi);
    $stmt->bindParam(':rezervasyon_id', $rezervasyon_id);

    if ($stmt->execute()) {
        echo "<script>alert('Rezervasyon başarıyla güncellendi.');
        window.location.href = 'admin.php';</script>";
        exit();
    } else {
        echo "<script>alert('Güncelleme sırasında bir hata oluştu.')</script>";
    }
}
?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
