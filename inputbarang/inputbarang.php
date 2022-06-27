<?php
    error_reporting(0);
    include '../koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <link rel="stylesheet" href="../css/inputbarang1.css">
        <?php
            include '../koneksi.php';
            // mengambil data barang dengan kode paling besar
            $query = mysqli_query($koneksi, "SELECT max(ID_BARANG) as kodeTerbesar FROM barang");
            $data = mysqli_fetch_array($query);
            $ID_BARANG = $data['kodeTerbesar'];

            // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
            // dan diubah ke integer dengan (int)
            $urutan = (int) substr($ID_BARANG, 3, 3);
                
            // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
            $urutan++;
                
            // membentuk kode barang baru
            // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
            // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
            // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
            $angka = "BRG";
            $ID_BARANG = $angka . sprintf("%03s", $urutan);

        ?>

        <?php 
        session_start();
        $koneksi=mysqli_connect("localhost","root","","lapakmahasiswa");
        if(!isset($_SESSION['EMAIL_PENJUAL'])){
            echo"<script>
                    alert('Harap Login terlebih dahulu untuk menampilkan menu ini!');
                </script>";
                echo "<script>location='loginpenjual.php'</script>";
        }
        ?>
    </head>
    <body>
        <?php
        $query = mysqli_query($koneksi,"SELECT * FROM penjual WHERE EMAIL_PENJUAL = '$_SESSION[EMAIL_PENJUAL]'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="input">
            <img src="../src/5.png" style="width:20%">
            <h2 style="text-align: center;">MASUKKAN BARANG ANDA</h2>
            <form action="prosesinputbarang.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <label for="ID_BARANG"> ID BARANG : </label><br>    
                <input type="text" name="ID_BARANG" id="ID_BARANG" value="<?php echo $ID_BARANG?>" class="tampilanform" readonly><br>
                <label for="ID_LAPAK"> ID LAPAK : </label><br>    
                <input type="text" name="ID_LAPAK" id="ID_LAPAK" value="<?php echo $row['ID_LAPAK'] ?>" class="tampilanform" readonly><br>
                <label for="NAMA_BARANG"> NAMA BARANG : </label><br>
                <input type="text" name="NAMA_BARANG" id="NAMA_BARANG" class="tampilanform" required><br>
                <label for="HARGA_BARANG"> HARGA BARANG : </label><br>
                <input type="number" name="HARGA_BARANG" id="HARGA_BARANG" class="tampilanform"><br>
                <div>
                        <label for="JENIS_BARANG">JENIS BARANG : </label><br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Elektronik" style="cursor:pointer;"> Elektronik <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Buku" style="cursor:pointer;"> Buku <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Pakaian" style="cursor:pointer;"> Pakaian <br>
                        <input type="radio" name="JENIS_BARANG" id="JENIS_BARANG" value="Lainnya" style="cursor:pointer;"> Lainnya <br>
                </div><br>
                <label for="STOK_BARANG"> STOCK BARANG : </label><br>    
                <input type="number" name="STOK_BARANG" id="STOK_BARANG" class="tampilanform" required><br>
                <label for="DESKRIPSI_BARANG">DESKRIPSI BARANG :</label><br>
                <textarea name="DESKRIPSI_BARANG" id="DESKRIPSI_BARANG" cols="30" rows="10" class="tampilanformpanjang" required></textarea>
                <label for="FOTO_BARANG">FOTO BARANG :</label>
                <input type="file" name="FOTO_BARANG" id="FOTO_BARANG" style="margin-bottom: 15px; font-size: medium; color:#065776;" required><br>
                <input type="checkbox" style="cursor:pointer; margin-bottom:5%;">SEMUA DATA SUDAH BENAR !<br>
                <input type="submit" name="simpan" id="simpan" value="Submit" class="button" style="cursor: pointer;"><br><br>
                <button onclick="window.location.href='../admin/index.php'" class="button1" style="cursor: pointer;" >Keluar
                </div>
            </form>
        </div>
    </body>
</html>