<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf_file'])) {
    $file_name = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_size = $_FILES['pdf_file']['size'];
    $file_error = $_FILES['pdf_file']['error'];

    $allowed_extensions = ['pdf'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        if ($file_size > 2 * 1024 * 1024) {  // Check if file size > 2MB
            $upload_path = 'uploads/' . $file_name;
            if (move_uploaded_file($file_tmp, $upload_path)) {
                echo "File berhasil diupload.";
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "File harus lebih besar dari 2MB.";
        }
    } else {
        echo "Hanya file PDF yang diizinkan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Menu PDF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Unggah Menu Ramen Bajuri</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="pdf_file">Pilih file PDF menu:</label>
            <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>
            <button type="submit">Unggah Menu</button>
        </form>
    </div>
</body>
</html>
