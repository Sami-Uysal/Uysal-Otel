<?php
require_once('baglanti.php');
session_start();

$_SESSION['kullaniciadi'] = "";
$_SESSION['avatar'] = "";
$_SESSION['email'] = "";
$_SESSION['kullaniciid'] = "";
$_SESSION['basarisiz'] = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    try {
        $sql = "SELECT * FROM kullanicilar WHERE email=:email AND sifre=:sifre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sifre', $sifre);
        $stmt->execute();

        $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            echo "Giriş Başarılı!";
            $_SESSION['kullaniciadi'] = $kullanici['ad'];
            $_SESSION['avatar'] = $kullanici['resim_konum'];
            $_SESSION['email'] = $kullanici['email'];
            $_SESSION['kullaniciid'] = $kullanici['id'];
        } else {
            echo "Email veya şifre yanlış!";
            $_SESSION['basarisiz'] = true;
        }
        $conn = null;
    } catch (PDOException $e) {
        echo "Bağlantı Hatası: " . $e->getMessage();
    }
}

?>


