<?php

namespace ProteanCode\Cipherio\Strategies;

use ProteanCode\Cipherio\Interfaces\Cipher;

/**
 * The Atbash Cipher is a classical substitution cipher that dates back to the Hebrew script
 * and is one of the simplest forms of encryption. Unlike the Caesar cipher, which shifts
 * letters by a fixed number of positions, the Atbash cipher **reverses the alphabet**.
 *
 * Concept:
 * Each letter of the alphabet is mapped to its "mirror" letter from the other end:
 * - 'A' becomes 'Z'
 * - 'B' becomes 'Y'
 * - 'C' becomes 'X'
 * - …
 * - 'Z' becomes 'A'
 *
 * Characteristics:
 * 1. **Symmetric cipher:** The same function is used for both encryption and decryption.
 *    Applying the cipher twice returns the original text.
 *
 * 2. **Case sensitivity:** Typically, uppercase and lowercase letters are handled separately
 *    to preserve the original casing. Numbers, punctuation, and spaces are usually left unchanged.
 *
 * 3. **No key required:** Unlike the Caesar cipher, Atbash does not require a shift key because
 *    the mapping is fixed and deterministic.
 *
 * 4. **Historical significance:** The Atbash cipher originates from ancient Hebrew texts and
 *    was used as a simple method of encoding messages. It is more of a substitution pattern
 *    than a secure encryption method by modern standards.
 *
 * Example:
 *  Plaintext:  "HELLO, WORLD!"
 *  Encryption:
 *      H -> S
 *      E -> V
 *      L -> O
 *      L -> O
 *      O -> L
 *      , -> ,  (unchanged)
 *      W -> D
 *      O -> L
 *      R -> I
 *      L -> O
 *      D -> W
 *      ! -> !  (unchanged)
 *  Ciphertext: "SVOOL, DLIOW!"
 *
 * Security considerations:
 * The Atbash cipher is not secure for modern cryptographic use, as the mapping is fixed
 * and easily reversed. However, it is an excellent example for educational purposes,
 * illustrating substitution ciphers and symmetry in encryption.
 *
 * Implementation notes:
 * - Each letter is transformed using its position in the alphabet.
 * - Non-alphabetic characters are preserved.
 * - Encryption and decryption are identical due to the fixed mirroring of letters.
 */
class AtBashStrategy implements Cipher
{
    public function __construct(
        protected string $token,
    )
    {
    }

    public function encrypt(): string
    {
        return $this->process($this->token);
    }

    public function decrypt(): string
    {
        return $this->process($this->token);
    }

    protected function process(string $text): string
    {
        $result = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (ctype_upper($char)) {
                $result .= chr(ord('Z') - (ord($char) - ord('A')));
            } elseif (ctype_lower($char)) {
                $result .= chr(ord('z') - (ord($char) - ord('a')));
            } else {
                $result .= $char; // leave digits, punctuation, spaces unchanged
            }
        }

        return $result;
    }
}