<?php
 
require_once ('baglanti.php');
 
if (isset($_POST['Submit'])) {
 
    move_uploaded_file($_FILES["resim"]["tmp_name"],"dosyalar/" . $_FILES["resim"]["name"]);			
    $dosya=$_FILES["resim"]["ad"];
    $ad = $_POST['ad'];
    $email = $_POST['email'];
    $telefon = $_POST['phone'];
    $adres = $_POST['adres'];
    $zip_kodu = $_POST['zip_kodu'];
    $dogum_gunu = $_POST['dogum_gunu'];
    $sifre = $_POST['sifre'];

 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO kullanicilar (ad, email, telefon, adres, zip_kodu, dogum_gunu, sifre, resim_konum) VALUES ('$ad', '$email', '$telefon', '$adres', '$zip_kodu', '$dogum_gunu', '$sifre', '$dosya')";
    $conn->exec($sql);
    echo "<script>alert('Kayıt başarıyla yapıldı!!!');</script>";
}
?>
