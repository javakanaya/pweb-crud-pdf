    <?php
    // Load file koneksi.php
    include "koneksi.php";

    // Ambil data ID yang dikirim oleh form_ubah.php melalui URL
    $id = $_GET['id'];

    // Ambil Data yang Dikirim dari Form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Ambil data foto yang dipilih dari form
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    // Cek apakah user ingin mengubah fotonya atau tidak
    if (empty($foto)) {
        // Jika user tidak memilih file foto pada form 
        // Lakukan proses update tanpa mengubah fotonya  
        // Proses ubah data ke Database  
        $sql = $pdo->prepare("UPDATE siswa SET nis=:nis, nama=:nama, jenis_kelamin=:jk, telp=:telp, alamat=:alamat WHERE id=:id");
        $sql->bindParam(':nis', $nis);
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':jk', $jenis_kelamin);
        $sql->bindParam(':telp', $telp);
        $sql->bindParam(':alamat', $alamat);
        $sql->bindParam(':id', $id);

        //  Jalankan query
        $execute = $sql->execute();
        if ($sql) {
            // Cek jika proses simpan ke database sukses atau tidak    
            // Jika Sukses, Lakukan :   
            header("location: index.php"); // Redirect ke halaman index.php  
        } else {    // Jika Gagal, Lakukan :    
            echo "Terjadi kesalahan saat menyimpan ke database";
            echo "<br><a href='form-ubah.php'>Kembali Ke Form</a>";
        }
    } else {
        // Jika user memilih foto / mengisi input file foto pada form  
        // Lakukan proses update termasuk mengganti foto sebelumnya 
        // Rename nama fotonya dengan menambahkan tanggal dan jam upload  
        $fotobaru = date('dmYHis') . $foto;

        // Set path folder tempat menyimpan fotonya  
        $path = "images/" . $fotobaru;

        // Proses upload  
        if (move_uploaded_file($tmp, $path)) {

            // Cek apakah gambar berhasil diupload atau tidak    
            // Query untuk menampilkan data siswa berdasarkan ID yang dikirim    
            $sql = $pdo->prepare("SELECT foto FROM siswa WHERE id=:id");
            $sql->bindParam(':id', $id);

            // Eksekusi query insert
            $sql->execute();

            // Ambil semua data dari hasil eksekusi $sql       
            $data = $sql->fetch();

            // Cek apakah file foto sebelumnya ada di folder images
            // Jika foto ada     
            if (is_file("images/" . $data['foto'])) {
                // Hapus file foto sebelumnya yang ada di folder images    
                unlink("images/" . $data['foto']);
            }

            // Proses ubah data ke Database   
            $sql = $pdo->prepare("UPDATE siswa SET nis=:nis, nama=:nama, jenis_kelamin=:jk, telp=:telp, alamat=:alamat, foto=:foto WHERE id=:id");
            $sql->bindParam(':nis', $nis);
            $sql->bindParam(':nama', $nama);
            $sql->bindParam(':jk', $jenis_kelamin);
            $sql->bindParam(':telp', $telp);
            $sql->bindParam(':alamat', $alamat);
            $sql->bindParam(':foto', $fotobaru);
            $sql->bindParam(':id', $id);

            // Eksekusi query
            $execute = $sql->execute();
            if ($sql) {
                // Cek jika proses simpan ke database sukses atau tidak      
                // Jika Sukses, Lakukan :     
                // Redirect ke halaman index.php     
                header("location: index.php");
            } else {      
                // Jika Gagal, Lakukan :      
                echo "Terjadi kesalahan saat menyimpan ke database";
                echo "<br><a href='form-ubah.php'>Kembali Ke Form</a>";
            }
        } else {
            // Jika gambar gagal diupload, Lakukan :   
            echo "Terjadi kesalahan saat mengupload gambar";
            echo "<br><a href='form-ubah.php'>Kembali Ke Form</a>";
        }
    }
    ?>