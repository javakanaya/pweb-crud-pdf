<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

// Query untuk menampilkan data siswa berdasarkan ID yang dikirim
$sql = $pdo->prepare("SELECT foto FROM siswa WHERE id=:id");
$sql->bindParam(':id', $id);

// Eksekusi query insert
$sql->execute();

// Ambil semua data dari hasil eksekusi $sql
$data = $sql->fetch();

// Cek apakah file fotonya ada di folder images
// Jika foto ada unlink
if (is_file("images/" . $data['foto']))
    unlink("images/" . $data['foto']);

// Hapus foto yang telah diupload dari folder images
// Query untuk menghapus data siswa berdasarkan ID yang dikirim
$sql = $pdo->prepare("DELETE FROM siswa WHERE id=:id");
$sql->bindParam(':id', $id);

// Eksekusi / Jalankan query
$execute = $sql->execute();
if ($execute) {
    // Cek jika proses habus ke database sukses atau tidak  
    // Jika Sukses, Lakukan :  
    // Redirect ke halaman index.php
    header("location: index.php");
} else {
    // Jika Gagal, Lakukan :  
    echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
