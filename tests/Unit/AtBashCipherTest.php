<?php

namespace ProteanCode\Cipherio\Tests\Unit;

use ProteanCode\Cipherio\Enums\CipherType;
use ProteanCode\Cipherio\Factories\CipherFactory;
use ProteanCode\Cipherio\Tests\TestCase;

class AtBashCipherTest extends TestCase
{
    /**
     * @dataProvider randomStringProvider
     */
    public function testThatDecryptedValueEqualsEncryptedValue(string $testToken)
    {
        $encryptingCipher = CipherFactory::create(CipherType::AT_BASH, $testToken);
        $encrypted = $encryptingCipher->encrypt();

        $decryptingCipher = CipherFactory::create(CipherType::AT_BASH, $encrypted);
        $decrypted = $decryptingCipher->decrypt();

        $this->assertEquals($testToken, $decrypted);
    }

    public function testEncryptDecryptFixedCases(): void
    {
        $cases = [
            "Hello" => "Svool",
            "World" => "Dliow",
            "ABC"   => "ZYX",
            "xyz"   => "cba",
            "Atbash Cipher!" => "Zgyzhs Xrksvi!",
            "12345" => "12345", // numbers unchanged
        ];

        foreach ($cases as $original => $expectedEncrypted) {
            $encryptingCipher = CipherFactory::create(CipherType::AT_BASH, $original);
            $encrypted = $encryptingCipher->encrypt();

            $decryptingCipher = CipherFactory::create(CipherType::AT_BASH, $expectedEncrypted);
            $decrypted = $decryptingCipher->encrypt();

            $this->assertSame($expectedEncrypted, $encrypted, "Encryption failed for '$original'");
            $this->assertSame((string)$original, $decrypted, "Decryption failed for '$expectedEncrypted'");
        }
    }
}