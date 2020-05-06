<?php
session_start();
include 'koneksi.php';

$id = $_POST['id'];
$querysql = "SELECT * FROM `tbl_siswa` WHERE `tbl_siswa`.`id` = ?";
$prepare = $conn->prepare($querysql);
$prepare->bind_param('i', $id);
$prepare->execute();
$result = $prepare->get_result();
while ($row = $result->fetch_assoc()) {
    $data['id'] = $row["id"];
    $data['nama_siswa'] = $row["nama_siswa"];
    $data['jurusan'] = $row["jurusan"];
    $data['jenis_kelamin'] = $row["jenis_kelamin"];
    $data['tgl_masuk'] = $row["tgl_masuk"];
    $data['alamat'] = $row["alamat"];
}

echo json_encode($data);

$conn->close();
