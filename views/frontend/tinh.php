<?php
$conn = new PDO("mysql:host=localhost;dbname=tttn;charset=utf8", "root", "");
$stmt = $conn->prepare("SELECT matp, name  FROM tttn_devvn_tinhthanhpho");
$stmt->execute();
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
