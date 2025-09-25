<?php

use ProteanCode\Cipherio\Enums\CipherType;
use ProteanCode\Cipherio\Factories\CipherFactory;

if (!function_exists('caesar_encrypt')) {
    function caesar_encrypt(string $token, int $shift): string
    {
        $cipher = CipherFactory::create(CipherType::CAESAR, $token, $shift);

        return $cipher->encrypt();
    }
}

if (!function_exists('caesar_decrypt')) {
    function caesar_decrypt(string $token, int $shift): string
    {
        $cipher = CipherFactory::create(CipherType::CAESAR, $token, $shift);

        return $cipher->decrypt();
    }
}

if (!function_exists('atbash_encrypt')) {
    function atbash_encrypt(string $token): string
    {
        $cipher = CipherFactory::create(CipherType::AT_BASH, $token);

        return $cipher->encrypt();
    }
}

if (!function_exists('atbash_decrypt')) {
    function atbash_decrypt(string $token): string
    {
        $cipher = CipherFactory::create(CipherType::AT_BASH, $token);

        return $cipher->decrypt();
    }
}