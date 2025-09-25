<?php

namespace ProteanCode\Cipherio\Factories;

use ProteanCode\Cipherio\Enums\CipherType;
use ProteanCode\Cipherio\Interfaces\Cipher;
use ProteanCode\Cipherio\Strategies\AtBashStrategy;
use ProteanCode\Cipherio\Strategies\CaesarStrategy;

abstract readonly class CipherFactory
{
    public static function create(CipherType $cipher, string $token, ...$args): Cipher
    {
        return match ($cipher) {
            CipherType::CAESAR => new CaesarStrategy($token, ...$args),
            CipherType::AT_BASH => new AtBashStrategy($token),
            default => new CaesarStrategy($token, ...$args),
        };
    }
}