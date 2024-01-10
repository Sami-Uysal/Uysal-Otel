<?php 
session_start();
error_reporting(0);

if (isset($_SESSION['kullaniciadi'])) {
    $kullaniciadi = $_SESSION['kullaniciadi'];
}
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
    <link rel="stylesheet" href="css/hakkimizda.css">
</head>
<body>

<!-- Navbar  Başlangıç -->
<?php
$busayfa = 'hakkimizda';
include 'php/navbar.php';
?>
<!-- Navbar  Bitiş -->

  <div  class="container">
    <h2>Hakkımızda</h2>
    <form action="#" method="post">
      <textarea id="editor" rows="27" cols="100" readonly>
        Hoş Geldiniz! Biz Uysal Otel olarak, Şirketin Amacı hakkında size biraz bilgi vermek istiyoruz.

        Misyonumuz, müşterilerimize en iyi hizmeti sunmak ve onların ihtiyaçlarını karşılamak üzerine odaklanmıştır. Uysal Otel, 2023 tarihinden beri konaklama sektöründe faaliyet göstermektedir.

        Bizler, Uysal Otel'de çalışan her birey olarak, müşterilerimize sadece kaliteli ürünler/servisler sunmayı değil, aynı zamanda onların memnuniyetini ve güvenini kazanmayı da önemsiyoruz. Bu nedenle, ekibimiz sürekli olarak yenilikçi çözümler üzerinde çalışırken, müşteri geri bildirimlerini ve ihtiyaçlarını dikkate alarak kendimizi geliştirmeye devam ediyoruz.

        Bize duyulan güvenin farkındayız ve bu güveni korumak için titizlikle çalışıyoruz. Uysal Otel, sadece iş yapma amacı gütmeyen, aynı zamanda topluma ve çevreye duyarlı bir kuruluş olarak da öne çıkmayı hedeflemektedir. Sürdürülebilirlik ve toplumsal sorumluluk ilkeleri, faaliyetlerimizin merkezinde yer almaktadır.

        Bizimle birlikte olmanın, kalite ve güvenin yanı sıra iş ortaklarımız ve müşterilerimiz için de bir değer yaratacağına inanıyoruz. Uysal Otel ailesi olarak, her zaman daha iyisini hedefleyerek, yenilikçi ve etik değerlere sadık kalarak ilerlemeye devam ediyoruz.

        Eğer herhangi bir sorunuz veya geri bildiriminiz varsa, lütfen bizimle iletişime geçmekten çekinmeyin. Sizlerle olan iş birliğimizi daha da güçlendirmek için buradayız!

        Teşekkür ederiz.

        Saygılarımızla,
        Uysal Otel Ekibi
      </textarea>
    </form>
  </div>


<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<?php if($kullaniciadi === 'admin') echo  "
<script>
ClassicEditor
  .create(document.querySelector('#editor'))
  .catch(error => {
    console.error(error);
  });
</script>
"
?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>