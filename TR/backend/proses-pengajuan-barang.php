<?php
include "kelas-auction.php";
$act = new Auction();

$namaBarang = filter_input(INPUT_POST, 'txtNamaBarang', FILTER_SANITIZE_STRING);
$deskripsiBarang = filter_input(INPUT_POST, 'txtDeskripsiBarang', FILTER_SANITIZE_STRING);
$hargaAwal = filter_input(INPUT_POST, 'nmbHargaAwal', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$hargaBuyout = filter_input(INPUT_POST, 'nmbHargaBuyout', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$status = 'Pending';

if (isset($_FILES["imgFotoBarang"]) && $_FILES["imgFotoBarang"]["error"] === UPLOAD_ERR_OK) {
    $uploadDir = "../gambar/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileExtension = strtolower(pathinfo($_FILES["imgFotoBarang"]["name"], PATHINFO_EXTENSION));
    $fileName = uniqid() . '.' . $fileExtension;
    $filePath = $uploadDir . $fileName;

    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    $imageInfo = getimagesize($_FILES["imgFotoBarang"]["tmp_name"]);
    
    if ($imageInfo === false) {
        echo "<script>alert('File bukan gambar!');</script>";
        exit();
    }

    if ($_FILES["imgFotoBarang"]["size"] > 10000000) {
        echo "<script>alert('Ukuran file terlalu besar. Maksimal 10MB.');</script>";
        exit();
    }

    if (!in_array($fileExtension, $allowedFormats)) {
        echo "<script>alert('Format file tidak diizinkan. Gunakan JPG, JPEG, PNG ATAU GIF.');</script>";
        exit();
    }

    if (move_uploaded_file($_FILES["imgFotoBarang"]["tmp_name"], $filePath)) {
        $relativePath = '../gambar/' . $fileName;
        
        if ($act->ajukanBarang($namaBarang, $deskripsiBarang, $hargaAwal, $hargaBuyout, $relativePath, $status)) {
            echo "<script>
                alert('Pengajuan berhasil!');
                window.location.href='../frontend/view-page-barang-user.php';
            </script>";
            exit();
        } else {
            unlink($filePath);
            echo "<script>alert('Gagal ajukan barang!');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengunggah file!');</script>";
    }
} else {
    echo "<script>alert('File tidak valid!');</script>";
}
?>