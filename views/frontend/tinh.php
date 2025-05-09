<?php
$conn = new PDO("mysql:host=localhost;dbname=laravel;charset=utf8", "admin", "admin");
$stmt = $conn->prepare("SELECT matp, name  FROM tttn_devvn_tinhthanhpho");
$stmt->execute();
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
