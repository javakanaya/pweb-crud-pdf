<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>CRUD with Image</title>
</head>

<body>
    <section class="container mt-4">
        <h1 class="fw-semibold">Ubah Data Siswa</h1>
        <?php
        // Load file koneksi.php  
        include "koneksi.php";

        // Ambil data NIS yang dikirim oleh index.php melalui URL  
        $id = $_GET['id'];

        // Query untuk menampilkan data siswa berdasarkan ID yang dikirim  
        $sql = $pdo->prepare("SELECT * FROM siswa WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        // Eksekusi query insert  
        $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql  
        ?>

        <form method="post" action="proses-ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $data['nis']; ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <?php if ($data['jenis_kelamin'] == "Laki-laki") {
                    echo '<div class="form-check form-check-inline">';
                    echo '<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki" checked="checked">';
                    echo '<label class="form-check-label" for="inlineRadio1">Laki-laki</label>';
                    echo '</div>';
                    echo '<div class="form-check form-check-inline">';
                    echo '<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan">';
                    echo '<label class="form-check-label" for="inlineRadio2">Perempuan</label>';
                    echo ' </div>';
                } else {
                    echo '<div class="form-check form-check-inline">';
                    echo '<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-laki">';
                    echo '<label class="form-check-label" for="inlineRadio1">Laki-laki</label>';
                    echo '</div>';
                    echo '<div class="form-check form-check-inline">';
                    echo '<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" checked="checked">';
                    echo '<label class="form-check-label" for="inlineRadio2">Perempuan</label>';
                    echo ' </div>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $data['telp']; ?>">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $data['alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input class="form-control" type="file" id="foto" name="foto">
            </div>
            <input class="btn btn-success" type="submit" value="Ubah">
            <a class="btn btn-outline-danger" href="index.php">Batal</a>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>