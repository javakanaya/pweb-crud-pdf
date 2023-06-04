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

        <h1 class="fw-bold">Data Siswa</h1>
        <a class="btn btn-primary" href="form-simpan.php">+ Tambah Data</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";

                $sql = $pdo->prepare("SELECT * FROM siswa");
                $sql->execute();

                while ($data = $sql->fetch()) {
                    echo "<tr>";
                    echo "<td><img src='images/" . $data['foto'] . "' width='100' height='100'></td>";
                    echo "<td>" . $data['nis'] . "</td>";
                    echo "<td>" . $data['nama'] . "</td>";
                    echo "<td>" . $data['jenis_kelamin'] . "</td>";
                    echo "<td>" . $data['telp'] . "</td>";
                    echo "<td>" . $data['alamat'] . "</td>";
                    echo "<td><a class='btn btn-success' href='form-ubah.php?id=" . $data['id'] . "'>Ubah</a></td>";
                    echo "<td><a class='btn btn-danger' href='proses-hapus.php?id=" . $data['id'] . "'>Hapus</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>