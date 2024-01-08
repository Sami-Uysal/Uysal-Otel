<?php
require_once('baglanti.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $baslangic_tarihi = $_POST['baslangic_tarihi'];
    $bitis_tarihi = $_POST['bitis_tarihi'];

    try {
        if ($conn) { // Bağlantı varsa devam et
            $sql = "SELECT * FROM odalar WHERE oda_id NOT IN (
                    SELECT DISTINCT oda_id FROM rezervasyonlar 
                    WHERE baslangic_tarihi <= :bitis_tarihi AND bitis_tarihi >= :baslangic_tarihi
                )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bitis_tarihi', $bitis_tarihi);
            $stmt->bindParam(':baslangic_tarihi', $baslangic_tarihi);
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "Oda ID: " . $row["room_id"] . " - Oda Adı: " . $row["room_name"] . "<br>";
                }
            } else {
                echo "Uygun oda bulunamadı.";
            }

            $conn = null;
        } else {
            echo "Bağlantı hatası.";
        }
    } catch (PDOException $e) {
        echo "Bağlantı Hatası: " . $e->getMessage();
    }
}
?>

