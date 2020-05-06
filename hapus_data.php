<?php
session_start();
include 'koneksi.php';

$id = $_POST['id'];

$querysql = "DELETE FROM `tbl_siswa` WHERE `tbl_siswa`.`id` = ?";
$prepare = $conn->prepare($querysql);
$prepare->bind_param("i", $id);
$prepare->execute();

echo json_encode(['success' => 'SUKSES!']);

$conn->close();
