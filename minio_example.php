<?php

require 'minio_config.php';

function uploadFileToMinio($bucket, $filePath, $fileName) {
    $s3 = getMinioClient();

    try {
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $fileName,
            'SourceFile' => $filePath,
            'ACL'    => 'public-read',  // Menjadikan file dapat diakses publik
        ]);
        
        echo "File uploaded successfully. File URL: " . $result['ObjectURL'] . "\n";
    } catch (Aws\S3\Exception\S3Exception $e) {
        echo "Error uploading file: " . $e->getMessage() . "\n";
    }
}

function getFileFromMinio($bucket, $fileName) {
    $s3 = getMinioClient();

    try {
        $result = $s3->getObject([
            'Bucket' => $bucket,
            'Key'    => $fileName,
        ]);

        echo "File content:\n";
        echo $result['Body'];
    } catch (Aws\S3\Exception\S3Exception $e) {
        echo "Error retrieving file: " . $e->getMessage() . "\n";
    }
}

// Contoh penggunaan:
// Mengunggah file
$bucket = 'minio-iet';       // Nama bucket di MinIO
$filePath = '/test';  // Path file yang akan diunggah
$fileName = 'uploaded-file.txt';   // Nama file saat disimpan di MinIO
uploadFileToMinio($bucket, $filePath, $fileName);

// Mengambil file
getFileFromMinio($bucket, $fileName);
