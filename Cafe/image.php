<?php
require_once 'insert.php';

$pdo = connectDB();

$sql = 'SELECT * FROM cafe_table WHERE id = :id LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type: ' . $image['image_type']);
echo $image['image_content'];

unset($pdo);
exit();
?>