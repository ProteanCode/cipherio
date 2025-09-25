<?php

require_once __DIR__ . '/vendor/autoload.php';

$token = 'hello';
$shift = 1;

echo "Caesar original: " . $token . PHP_EOL;

$encrypted = caesar_encrypt($token, $shift);
$decrypted = caesar_decrypt($encrypted, $shift);

echo "Caesar encrypted: " . $encrypted . PHP_EOL;
echo "Caesar decrypted: " . $decrypted . PHP_EOL;