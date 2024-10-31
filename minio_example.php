<?php

require 'vendor/autoload.php'; // Pastikan autoload sudah diatur

use Aws\S3\S3Client; // Pastikan Anda menggunakan namespace yang tepat

function uploadFileToMinio($bucket, $filePath, $key) {
    // Konfigurasi S3 Client
    $s3 = new S3Client([
        'version' => 'latest',
        'region'  => 'us-east-1', // Ganti dengan region Anda
        'endpoint' => 'http://minio-server:9000', // Ganti dengan endpoint MinIO Anda
        'credentials' => [
            'key'    => 'YOUR_MINIO_ACCESS_KEY',
            'secret' => 'YOUR_MINIO_SECRET_KEY',
        ],
        'use_path_style_endpoint' => true,
    ]);

    try {
        // Mengunggah file
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $key,
            'SourceFile' => $filePath, // Path ke file yang ingin diunggah
        ]);

        echo "File uploaded successfully. File URL: " . $result['ObjectURL'] . "\n";
    } catch (Exception $e) {
        echo "Error uploading file: " . $e->getMessage() . "\n";
    }
}

// Ganti dengan nama bucket Anda dan key untuk file yang akan diunggah
$bucket = 'minio-iet';
$filePath = './sample.txt'; // Pastikan path ini benar
$key = 'uploaded-file.txt';

uploadFileToMinio($bucket, $filePath, $key);

?>
