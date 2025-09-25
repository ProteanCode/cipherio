<?php

require_once __DIR__ . '/vendor/autoload.php';

$token = 'Hello';

echo "Bacon original: " . $token . PHP_EOL;

$encrypted = bacon_encrypt($token);
$decrypted = bacon_decrypt($encrypted);

echo "Bacon encrypted: " . $encrypted . PHP_EOL;
echo "Bacon decrypted: " . $decrypted . PHP_EOL;