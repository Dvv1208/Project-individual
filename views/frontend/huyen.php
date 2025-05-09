<?php
$matp = 0;
if (isset($_GET['matp'])) $matp = $_GET['matp'];
settype($matp, "string");
$conn = new PDO("mysql:host=localhost;dbname=laravel;charset=utf8", "admin", "admin");
$stmt = $conn->prepare("SELECT maqh, name, matp  FROM tttn_devvn_quanhuyen WHERE matp=?");
$stmt->execute([$matp]);
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fillable = ['maqh', 'name', 'type', 'matp'];
echo json_encode($data);
