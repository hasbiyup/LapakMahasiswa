<?php
    error_reporting(0);
    include '../koneksi.php';

    if (isset($_POST['simpan'])) {
        $ID_BARANG=$_POST['ID_BARANG'];
        $ID_LAPAK=$_POST['ID_LAPAK'];
        $NAMA_BARANG=$_POST['NAMA_BARANG'];
        $HARGA_BARANG=$_POST['HARGA_BARANG'];
        $JENIS_BARANG=$_POST['JENIS_BARANG'];
        $STOK_BARANG=$_POST['STOK_BARANG'];
        $DESKRIPSI_BARANG=$_POST['DESKRIPSI_BARANG'];
        $FOTO_BARANG=$_FILES['FOTO_BARANG']['name'];
        $tmp=$_FILES['FOTO_BARANG']['tmp_name'];
        $path="imagebarang/".$FOTO_BARANG;

        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO barang VALUES ('$ID_BARANG' , '$ID_LAPAK', '$HARGA_BARANG', '$JENIS_BARANG', '$STOK_BARANG', '$DESKRIPSI_BARANG', '$FOTO_BARANG', '$NAMA_BARANG')";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
                die ("Query gagal dijalankan: ". mysqli_errno($koneksi). " - ". mysqli_error($koneksi));
            }
            else {
                echo "<script>window.location.href='alertinput.php'</script>";
            }
        }
    }
?>