<?php

namespace ProteanCode\Cipherio\Tests\Unit;

use ProteanCode\Cipherio\Enums\CipherType;
use ProteanCode\Cipherio\Factories\CipherFactory;
use ProteanCode\Cipherio\Tests\TestCase;

class CaesarCipherTest extends TestCase
{
    /**
     * @dataProvider randomStringProvider
     */
    public function testThatDecryptedValueEqualsEncryptedValue(string $testToken)
    {
        $encryptingCipher = CipherFactory::create(CipherType::CAESAR, $testToken, 1);
        $encrypted = $encryptingCipher->encrypt();

        $decryptingCipher = CipherFactory::create(CipherType::CAESAR, $encrypted, 1);
        $decrypted = $decryptingCipher->decrypt();

        $this->assertEquals($testToken, $decrypted);
    }

}