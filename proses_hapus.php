<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data NIS yang dikirim oleh index.php melalui URL
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // Lanjutkan dengan proses penghapusan
} else {
    // Tindakan jika ID tidak valid atau tidak ada
    echo "ID tidak valid. <a href='index.php'>Kembali</a>";
    // Atau lakukan redirect ke halaman lain jika diperlukan
    // header("Location: index.php");
    // exit();
}
// Query untuk menampilkan data siswa berdasarkan ID yang dikirim
$sql = $pdo->prepare("SELECT foto FROM siswa WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->execute(); // Eksekusi query insert
$data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql

// Cek apakah file fotonya ada di folder images
if(is_file("images/".$data['foto'])) // Jika foto ada
  unlink("images/".$data['foto']); // Hapus foto yang telah diupload dari folder images

// Query untuk menghapus data siswa berdasarkan ID yang dikirim
$sql = $pdo->prepare("DELETE FROM siswa WHERE id = :id");
$sql->bindParam(':id', $id);
$execute = $sql->execute(); // Eksekusi / Jalankan query

if($execute){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  header("location: index.php"); // Redirect ke halaman index.php
}else{
  // Jika Gagal, Lakukan :
  echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
?>