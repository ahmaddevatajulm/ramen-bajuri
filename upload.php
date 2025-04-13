<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf_file'])) {
    $file_name = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_size = $_FILES['pdf_file']['size'];
    $file_error = $_FILES['pdf_file']['error'];

    $allowed_extensions = ['pdf'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Menentukan batas ukuran file (10MB = 10 * 1024 * 1024)
    $max_size = 25 * 1024 * 1024;  // 10MB

    if (in_array($file_ext, $allowed_extensions)) {
        if ($file_size <= $max_size) {  // Memeriksa apakah ukuran file <= 10MB
            $upload_path = 'uploads/' . $file_name;
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Pesan berhasil diupload
                echo '<div class="alert success">
                        <span class="icon">&#10003;</span> 
                        <strong>Berhasil!</strong> File telah berhasil diunggah.
                      </div>';
            } else {
                echo '<div class="alert error">
                        <span class="icon">&#10060;</span> 
                        <strong>Gagal!</strong> Terjadi kesalahan saat mengunggah file.
                      </div>';
            }
        } else {
            echo '<div class="alert error">
                    <span class="icon">&#10060;</span> 
                    <strong>Gagal!</strong> File terlalu besar. Maksimum ukuran file adalah 10MB.
                  </div>';
        }
    } else {
        echo '<div class="alert error">
                <span class="icon">&#10060;</span> 
                <strong>Gagal!</strong> Hanya file PDF yang diizinkan.
              </div>';
    }
}
?>
