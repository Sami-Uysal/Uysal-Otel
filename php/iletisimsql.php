<!DOCTYPE html>
<html>
<head>
    <title>İletişim Formu</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $email = $_POST['email'];
    $mesaj = $_POST['mesaj'];

    $alici_email = "samiuysal.business@gmail.com";

    $konu = "İletişim Formundan Yeni Mesaj";

    $icerik = "Ad: $ad\n E-posta: $email\n Mesaj: $mesaj";

    $basliklar = "From: $email\r\nReply-To: $email\r\n";

    if (mail($alici_email, $konu, $icerik, $basliklar)) {
        echo "<p>E-posta başarıyla gönderildi, teşekkür ederiz!</p>";
    } else {
        echo "<p>E-posta gönderilirken bir hata oluştu.</p>";
    }
}
?>


</body>
</html>