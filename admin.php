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
$busayfa = 'admin';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->


<?php

$sql = "SELECT r.rezervasyon_id, r.baslangic_tarihi, r.bitis_tarihi, o.oda_adi, u.ad 
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
                        <th>Tarih Aralığı</th>
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
                                <td class="align-middle">
                                    <?php
                                        $baslangic_tarih = new DateTime($row["baslangic_tarihi"]);
                                        $bitis_tarih = new DateTime($row["bitis_tarihi"]);
                                        echo $baslangic_tarih->format('d-m-Y') . ' / ' . $bitis_tarih->format('d-m-Y');
                                    ?>
                                </td>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yeniRezervasyonModal">
                Yeni Rezervasyon Ekle
            </button>
        </div>
    </div>
</div>


<div class="modal fade" id="yeniRezervasyonModal" tabindex="-1" aria-labelledby="yeniRezervasyonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yeniRezervasyonModalLabel">Yeni Rezervasyon Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form" class="btn btn-primary" name="ekle">Rezervasyon Ekle</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h1>Tüm Odalar</h1>
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                <?php
                $odalar = $conn->query("SELECT * FROM odalar");
                if (!empty($odalar)) {
                    foreach ($odalar as $oda) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="images/rooms/<?php echo $oda['oda_resim']; ?>" class="card-img-top" alt="<?php echo $oda['oda_adi']; ?>">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $oda['oda_adi']; ?></h4>
                                    <p class="card-text"><?php echo $oda['oda_aciklamasi']; ?></p>
                                    <p class="card-text" style='font-weight: bold;'>Gecelik fiyat: <?php echo $oda['oda_fiyat']; ?></p>
                                    <p class="card-text">Oda Tipi: <?php echo $oda['oda_tipi']; ?></p>
                                    <p class="card-text">Kapasite: <?php echo $oda['oda_kapasitesi']; ?></p>
                                    <form action="" method="POST">
                                        <a href="odaduzenle.php?id=<?php echo $oda['oda_id']; ?>" class="btn btn-dark">Düzenle</a>
                                        <input type="hidden" name="id" value="<?php echo $oda['oda_id']; ?>">
                                        <button type="submit" class="btn btn-danger" name="odasil">Odayı Sil</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Hiç oda bulunamadı.</p>";
                }
                ?>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yeniOdaModal">
                Yeni Oda Ekle
            </button>
        </div>
    </div>
</div>



<!-- Modal for Adding New Room -->
<div class="modal fade" id="yeniOdaModal" tabindex="-1" aria-labelledby="yeniOdaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yeniOdaModalLabel">Yeni Oda Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="odaForm" action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="oda_adi" class="form-label">Oda Adı</label>
                        <input type="text" class="form-control" id="oda_adi" name="oda_adi" required>
                    </div>
                    <div class="mb-3">
                        <label for="oda_aciklama" class="form-label">Oda Açıklaması</label>
                        <textarea class="form-control" id="oda_aciklama" name="oda_aciklama" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="oda_fiyat" class="form-label">Gecelik Fiyat</label>
                        <input type="number" class="form-control" min="1" id="oda_fiyat" name="oda_fiyat" required>
                    </div>
                    <div class="mb-3">
                        <label for="oda_tipi" class="form-label">Oda Tipi</label>
                        <input type="text" class="form-control" id="oda_tipi" name="oda_tipi" required>
                    </div>
                    <div class="mb-3">
                        <label for="oda_kapasitesi" class="form-label">Oda Kapasitesi</label>
                        <input type="number" class="form-control" min="1" id="oda_kapasitesi" name="oda_kapasitesi" required>
                    </div>
                    <div class="mb-3">
                        <label for="oda_resim" class="form-label">Oda Resmi</label>
                        <input type="file" class="form-control" id="oda_resim" name="oda_resim" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="odaForm" class="btn btn-primary" name="odaekle">Oda Ekle</button>
            </div>
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
        echo "<script>alert('Yeni rezervasyon oluşturuldu.'); window.location.href = 'admin.php';</script>";
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
        echo "<script>alert('Rezervasyon başarıyla silindi.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Rezervasyon silinirken bir hata oluştu.')</script>";
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['odaekle'])) {


    $dosyaAdi = uniqid() . "_" . $_FILES["oda_resim"]["name"];
    move_uploaded_file($_FILES["oda_resim"]["tmp_name"], "images/rooms/" . $dosyaAdi);

    $oda_adi = $_POST['oda_adi'];
    $oda_aciklama = $_POST['oda_aciklama'];
    $oda_fiyat = $_POST['oda_fiyat'];
    $oda_tipi = $_POST['oda_tipi'];
    $oda_kapasitesi = $_POST['oda_kapasitesi'];
    
    

    $sql = "INSERT INTO odalar (oda_adi, oda_aciklamasi, oda_fiyat, oda_resim, oda_tipi, oda_kapasitesi) 
            VALUES (:oda_adi, :oda_aciklama, :oda_fiyat, :oda_resim, :oda_tipi, :oda_kapasitesi)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oda_adi', $oda_adi);
    $stmt->bindParam(':oda_aciklama', $oda_aciklama);
    $stmt->bindParam(':oda_fiyat', $oda_fiyat);
    $stmt->bindParam(':oda_resim', $dosyaAdi);
    $stmt->bindParam(':oda_tipi', $oda_tipi);
    $stmt->bindParam(':oda_kapasitesi', $oda_kapasitesi);

    if ($stmt->execute()) {
        echo "<script>alert('Yeni oda oluşturuldu.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Veritabanına eklerken bir hata oluştu.')</script>";
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['odasil'])) {
    $oda_id = $_POST['id'];

    $silme_sorgusu = "DELETE FROM odalar WHERE oda_id = :oda_id";
    $stmt = $conn->prepare($silme_sorgusu);
    $stmt->bindParam(':oda_id', $oda_id);

    if ($stmt->execute()) {
        echo "<script>alert('Oda başarıyla silindi.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('Oda silinirken bir hata oluştu.')</script>";
    }
}
?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

