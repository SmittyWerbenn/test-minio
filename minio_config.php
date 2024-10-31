<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;

function getMinioClient() {
    return new S3Client([
        'version'     => 'latest',
        'region'      => 'us-east-1',
        'endpoint'    => 'http://10.14.153.117:9000', // Ganti dengan URL MinIO Anda
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key'    => '3wVZREQt28AgO36dLBz3',     // Ganti dengan Access Key MinIO Anda
            'secret' => '5JI4c5CytoMjzo9CdFBKTZaUldJaTvmOpg3zUlLQ',     // Ganti dengan Secret Key MinIO Anda
        ],
    ]);
}
