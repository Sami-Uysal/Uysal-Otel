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
            $dosyaAdi = uniqid() . '_' . $_FILES["resim"]["name"];
            $dosyaYolu = "../dosyalar/" . $dosyaAdi;
            move_uploaded_file($_FILES["resim"]["tmp_name"], $dosyaYolu);
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO kullanicilar (ad, email, telefon, adres, zip_kodu, dogum_gunu, sifre, resim_konum) VALUES (:ad, :email, :telefon, :adres, :zip_kodu, :dogum_gunu, :sifre, :dosya)";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':ad', $ad);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefon', $telefon);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':zip_kodu', $zip_kodu);
            $stmt->bindParam(':dogum_gunu', $dogum_gunu);
            $stmt->bindParam(':sifre', $sifre);
            $stmt->bindParam(':dosya', $dosyaAdi);
    
            $stmt->execute();
            echo "Kayıt başarıyla yapıldı!!!";
            $conn = null;
        } catch (PDOException $e) {
            echo "Kayıt Hatası: " . $e->getMessage();
        }
    }
}
?>

