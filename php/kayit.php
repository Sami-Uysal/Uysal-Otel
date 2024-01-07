<?php
require_once ('baglanti.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $email = $_POST['email'];
    $telefon = $_POST['phone'];
    $adres = $_POST['adres'];
    $zip_kodu = $_POST['zip_kodu'];
    $dogum_gunu = $_POST['dogum_gunu'];
    $sifre = $_POST['sifre'];
    $sifreDogrula = $_POST['sifre_dogrula'];

    if ($sifre !== $sifreDogrula) {
        echo "Şifreler eşleşmiyor. Lütfen aynı şifreyi girin.";
    } else {
        try {
            move_uploaded_file($_FILES["resim"]["tmp_name"], "../dosyalar/" . $_FILES["resim"]["name"]);
            $dosya = $_FILES["resim"]["name"];

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO kullanicilar (ad, email, telefon, adres, zip_kodu, dogum_gunu, sifre, resim_konum) VALUES ('$ad', '$email', '$telefon', '$adres', '$zip_kodu', '$dogum_gunu', '$sifre', '$dosya')";
            $conn->exec($sql);
            echo "Kayıt başarıyla yapıldı!!!";
        } catch (PDOException $e) {
            echo "Kayıt Hatası: " . $e->getMessage();
        }
    }
}
?>