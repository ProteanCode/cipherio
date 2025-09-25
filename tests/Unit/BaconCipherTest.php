<?php

namespace ProteanCode\Cipherio\Tests\Unit;

use ProteanCode\Cipherio\Enums\CipherType;
use ProteanCode\Cipherio\Factories\CipherFactory;
use ProteanCode\Cipherio\Tests\TestCase;

class BaconCipherTest extends TestCase
{
    /**
     * @dataProvider randomStringProvider
     */
    public function testThatDecryptedValueEqualsEncryptedValue(string $testToken)
    {
        $testToken = strtoupper(preg_replace('/[^AB]/i', '', $testToken)); // remove invalid chars

        $encryptingCipher = CipherFactory::create(CipherType::BACON, $testToken);
        $encrypted = $encryptingCipher->encrypt();

        $decryptingCipher = CipherFactory::create(CipherType::BACON, $encrypted);
        $decrypted = $decryptingCipher->decrypt();

        $this->assertEquals($testToken, $decrypted);
    }

    public function testEncryptDecryptFixedCases(): void
    {
        $cases = [
            "A" => "AAAAA",
            "B" => "AAAAB",
            "AB" => "AAAAAAAAAB",
        ];

        foreach ($cases as $original => $expectedEncrypted) {
            $encryptingCipher = CipherFactory::create(CipherType::BACON, $original);
            $encrypted = $encryptingCipher->encrypt();

            $decryptingCipher = CipherFactory::create(CipherType::BACON, $expectedEncrypted);
            $decrypted = $decryptingCipher->decrypt();

            $this->assertSame($expectedEncrypted, $encrypted, "Encryption failed for '$original'");
            $this->assertSame((string)$original, $decrypted, "Decryption failed for '$expectedEncrypted'");
        }
    }
}