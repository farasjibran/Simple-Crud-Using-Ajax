<?php
session_start();
include 'koneksi.php';

$id = stripslashes(strip_tags(htmlspecialchars($_POST['id'], ENT_QUOTES)));
$nama_siswa = stripslashes(strip_tags(htmlspecialchars($_POST['nama_siswa'], ENT_QUOTES)));
$alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'], ENT_QUOTES)));
$jurusan = stripslashes(strip_tags(htmlspecialchars($_POST['jurusan'], ENT_QUOTES)));
$kel = stripslashes(strip_tags(htmlspecialchars($_POST['kel'], ENT_QUOTES)));
$tanggal_masuk = stripslashes(strip_tags(htmlspecialchars($_POST['tanggal_masuk'], ENT_QUOTES)));

if ($id != "") {
    $querysql = "UPDATE tbl_siswa SET nama_siswa = ?, alamat = ?, jurusan = ?, jenis_kelamin = ?, tgl_masuk = ? WHERE tbl_siswa.id = ?;";
    $prepare = $conn->prepare($querysql);
    $prepare->bind_param("sssssi", $nama_siswa, $alamat, $jurusan, $kel, $tanggal_masuk, $id);
    $prepare->execute();
    echo $querysql;
} else {
    $querysql = "INSERT INTO `tbl_siswa` (`nama_siswa`, `alamat`, `jurusan`, `jenis_kelamin`, `tgl_masuk`) VALUES (?, ?, ?, ?, ?);";
    $prepare = $conn->prepare($querysql);
    $prepare->bind_param("sssss", $nama_siswa, $alamat, $jurusan, $kel, $tanggal_masuk);
    $prepare->execute();
    echo $querysql;
}

echo json_encode(['success' => 'SUKSES!']);

$conn->close();
