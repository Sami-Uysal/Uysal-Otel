<?php
$sunucuadi = "localhost";
$kadi = "root";
$sifre = "";
$vtadi = "uysalotel";
 

try {
  $conn = new PDO("mysql:host=$sunucuadi;dbname=$vtadi", $kadi, $sifre);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}

?>