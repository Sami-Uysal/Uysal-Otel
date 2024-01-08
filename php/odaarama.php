<?php
require_once('baglanti.php');
session_start();

$_SESSION['oda_adi'] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $baslangic_tarihi = date("Y-m-d", strtotime($_POST['baslangic_tarihi']));
    $bitis_tarihi = date("Y-m-d", strtotime($_POST['bitis_tarihi']));

    try {
        if ($conn) {
            $sql = "SELECT * FROM odalar WHERE oda_id NOT IN (
                SELECT DISTINCT oda_id FROM rezervasyonlar 
                WHERE baslangic_tarihi <= :bitis_tarihi_param AND bitis_tarihi >= :baslangic_tarihi_param
            )";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bitis_tarihi_param', $bitis_tarihi_param);
            $stmt->bindParam(':baslangic_tarihi_param', $baslangic_tarihi_param);
    
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $counter = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      
                    echo '<div class="col-lg-4 mb-3">';
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo "<h5 class='card-title'>Oda ID: " . $row["oda_id"] . "</h5>";
                    echo "<p class='card-text'>Oda Adı: " . $row["oda_adi"] . "</p>";
            
                    echo '<a href="#" class="btn btn-primary">Bu Odayı Seç</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $counter++;
  
                    if ($counter % 3 === 0) {
                        echo '</div><div class="row mt-3 justify-content-center">';
                    }
                }
            } else {
                echo '<div class="col-lg-12">';
                echo '<p>Uygun oda bulunamadı.</p>';
                echo '</div>';
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



