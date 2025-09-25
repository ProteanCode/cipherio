<?php

require_once __DIR__ . '/vendor/autoload.php';

$token = 'AZ';
$shift = 1;

echo "At bash original: " . $token . PHP_EOL;

$encrypted = atbash_encrypt($token);
$decrypted = atbash_decrypt($encrypted);

echo "Caesar encrypted: " . $encrypted . PHP_EOL;
echo "Caesar decrypted: " . $decrypted . PHP_EOL;