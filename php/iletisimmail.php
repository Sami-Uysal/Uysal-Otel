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

            //Gönderen mail adresi ve şifresi
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '@gmail.com';
            $mail->Password   = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Gönderen mail adresi
            $mail->setFrom('@gmail.com', 'Uysal Iletisim');

            //Alıcı mail adresi
            $mail->addAddress('@gmail.com', 'Iletisim');

            $mail->isHTML(true);
            $mail->Subject = 'Iletisim Formu';
            $mail->Body    = "Ad: $ad<br>E-posta: $email<br>Mesaj: $mesaj";

            $mail->send();
            echo '<script>alert("E-posta başarılı bir şekilde gönderildi. Teşekkürler! :) ");</script>';
        } catch (Exception $e) {
            echo '<script>alert("E-posta gönderilirken bir hata oluştu:");</script>', $mail->ErrorInfo;
        }
    }
?>
