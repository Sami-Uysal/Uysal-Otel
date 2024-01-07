<?php

require_once('baglanti.php');

$_SESSION['kullaniciadi'] = "";
<<<<<<< HEAD
$_SESSION['avatar'] = "";
$_SESSION['email'] = "";
=======
>>>>>>> parent of c772242 (Admin added.)

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    try {
        $sql = "SELECT * FROM kullanicilar WHERE email=:email AND sifre=:sifre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sifre', $sifre);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Giriş Başarılı!";
            $_SESSION['kullaniciadi'] = $user['ad'];
<<<<<<< HEAD
            $_SESSION['avatar'] = $user['resim_konum'];
            $_SESSION['email'] = $user['email'];
=======
>>>>>>> parent of c772242 (Admin added.)
        } else {
            echo "Email veya şifre yanlış!";
        }
    } catch (PDOException $e) {
        echo "Bağlantı Hatası: " . $e->getMessage();
    }
}

?>


