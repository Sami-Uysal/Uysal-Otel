<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/language/phpmailer.lang-tr.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ad = $_POST['ad'];
        $email = $_POST['email'];
        $mesaj = $_POST['mesaj'];

    
        $mail = new PHPMailer(true);

        try {
            // SMTP ayarları
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'uysalotel.iletisim@gmail.com';
            $mail->Password   = 'kfvx poqh yudp jitl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('uysalotel.iletisim@gmail.com', 'Uysal Iletisim');

            $mail->addAddress('uysalotel.iletisim@gmail.com', 'Iletisim');

            $mail->isHTML(true);
            $mail->Subject = 'Iletisim Formu';
            $mail->Body    = "Ad: $ad<br>E-posta: $email<br>Mesaj: $mesaj";

            $mail->send();
            echo 'E-posta başarıyla gönderildi!';
        } catch (Exception $e) {
            echo 'E-posta gönderilirken bir hata oluştu: ', $mail->ErrorInfo;
        }
    }
?>
