<?php
    require_once('php/baglanti.php');
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
$currentPage = 'admin';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

<?php

$sql = "SELECT r.rezervasyon_id, o.oda_adi, u.ad 
                                FROM rezervasyonlar r 
                                INNER JOIN odalar o ON r.oda_id = o.oda_id
                                INNER JOIN kullanicilar u ON r.kullanici_id = u.id";

$reservasyonlar = $conn->query($sql);
?>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1>Tüm Rezervasyonlar</h1>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Oda Adı</th>
                        <th>Kullanıcı Adı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($reservasyonlar->rowCount() > 0) {
                        while ($row = $reservasyonlar->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td class="align-middle"><?php echo $row["rezervasyon_id"]; ?></td>
                                <td class="align-middle"><?php echo $row["oda_adi"]; ?></td>
                                <td class="align-middle"><?php echo $row["ad"]; ?></td>
                                <td>
                                    <form action="" method="POST">
                                    <a href="rezervasyonduzenle.php?id=<?php echo $row["rezervasyon_id"]; ?>" class="btn btn-dark">Düzenle</a>
                                        <input type="hidden" name="id" value="<?php echo $row["rezervasyon_id"]; ?>">
                                        <button type="submit" class="btn btn-danger" name="sil">Rezervasyonu Sil</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>Rezervasyon bulunamadı.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1>Yeni Rezervasyon Ekle</h1>
            <form id="form" action="" method="POST">
                <div class="mb-3">
                    <label for="oda_adi" class="form-label">Oda Adı</label>
                    <select class="form-select" id="oda_adi" name="oda_adi" required>
                        <?php
                            $odalar = $conn->query("SELECT oda_id, oda_adi FROM odalar");
                            while ($oda = $odalar->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $oda["oda_id"] . "'>" . $oda["oda_adi"] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kullanici_ad" class="form-label">Kullanıcı Adı</label>
                    <select class="form-select" id="kullanici_ad" name="kullanici_ad" required>
                        <?php
                            $kullanicilar = $conn->query("SELECT id, ad FROM kullanicilar");
                            while ($kullanici = $kullanicilar->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $kullanici["id"] . "'>" . $kullanici["ad"] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                    <input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" required>
                </div>
                <div class="mb-3">
                    <label for="bitis_tarihi" class="form-label">Bitiş Tarihi</label>
                    <input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi" required>
                </div>
                <button type="submit" class="btn btn-primary" name="ekle">Rezervasyon Ekle</button>
            </form>
        </div>
    </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ekle'])) {

    $oda_id = $_POST['oda_adi'];
    $kullanici_id = $_POST['kullanici_ad'];
    $baslangic_tarihi = $_POST['baslangic_tarihi'];
    $bitis_tarihi = $_POST['bitis_tarihi'];

    $baslangic_date = new DateTime($baslangic_tarihi);
    $bitis_date = new DateTime($bitis_tarihi);

    $baslangic_tarih_formatli = $baslangic_date->format('Y-m-d');
    $bitis_tarih_formatli = $bitis_date->format('Y-m-d');

    $sql = "INSERT INTO rezervasyonlar (oda_id, kullanici_id, baslangic_tarihi, bitis_tarihi) VALUES (:oda_id, :kullanici_id, :baslangic_tarihi, :bitis_tarihi)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oda_id', $oda_id);
    $stmt->bindParam(':kullanici_id', $kullanici_id);
    $stmt->bindParam(':baslangic_tarihi', $baslangic_tarihi);
    $stmt->bindParam(':bitis_tarihi', $bitis_tarihi);

    if ($stmt->execute()) {
        echo "<script>alert('Yeni rezervasyon oluşturuldu.')</script>";
    } else {

        echo "<script>alert('Veritabanına eklerken bir hata oluştu.')</script>";
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sil'])) {
    $rezervasyon_id = $_POST['id'];

    $silme_sorgusu = "DELETE FROM rezervasyonlar WHERE rezervasyon_id = :rezervasyon_id";
    $stmt = $conn->prepare($silme_sorgusu);
    $stmt->bindParam(':rezervasyon_id', $rezervasyon_id);

    if ($stmt->execute()) {
        echo "<script>alert('Rezervasyon başarıyla silindi.')</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Rezervasyon silinirken bir hata oluştu.')</script>";
    }
}
?>

<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

