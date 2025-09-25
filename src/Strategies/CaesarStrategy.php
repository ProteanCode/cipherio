<?php

namespace ProteanCode\Cipherio\Strategies;

use ProteanCode\Cipherio\Interfaces\Cipher;

/**
 * The Caesar Cipher is one of the simplest and most well-known classical substitution ciphers,
 * named after Julius Caesar, who reportedly used it to encode his private correspondence.
 *
 * Concept:
 * The Caesar cipher works by **shifting each letter of the plaintext by a fixed number of positions
 * down or up the alphabet**. The shift value, often called the "key," determines how many positions
 * each letter is moved. For example, with a shift of 3:
 *
 *  Plaintext:  "HELLO"
 *  Shift:      3
 *  Ciphertext: "KHOOR"
 *
 * Characteristics:
 * 1. **Alphabet-based substitution:** Only letters are typically shifted. Uppercase and lowercase
 *    letters can be handled separately to preserve case, while numbers, spaces, and punctuation
 *    are usually left unchanged.
 *
 * 2. **Shift wraps around:** If the shift moves a letter past 'Z' (or 'z'), it wraps around to
 *    the beginning of the alphabet. For example, with a shift of 3, 'Y' becomes 'B'.
 *
 * 3. **Encryption and decryption:**
 *    - Encryption: Each letter is shifted forward by the key value.
 *    - Decryption: Each letter is shifted backward by the same key value.
 *    The process is completely reversible using the same key.
 *
 * 4. **Key sensitivity:** The security of the Caesar cipher relies entirely on the secrecy
 *    of the shift key. With only 25 possible shifts (excluding a shift of 0), the cipher is
 *    extremely easy to break using brute-force or frequency analysis.
 *
 * 5. **Symmetry with negative shifts:** A left shift of N is equivalent to a right shift of
 *    (26 - N), which can simplify decryption.
 *
 * Example:
 *  Plaintext:  "HELLO, WORLD!"
 *  Shift:      3
 *  Encryption:
 *      H -> K
 *      E -> H
 *      L -> O
 *      L -> O
 *      O -> R
 *      , -> ,  (unchanged)
 *      W -> Z
 *      O -> R
 *      R -> U
 *      L -> O
 *      D -> G
 *      ! -> !  (unchanged)
 *  Ciphertext: "KHOOR, ZRUOG!"
 *
 * Historical and educational significance:
 * The Caesar cipher demonstrates the concept of substitution ciphers and
 * modular arithmetic in encryption. While it offers virtually no security
 * in modern cryptography, it is widely used for educational purposes and
 * simple puzzles.
 */
class CaesarStrategy implements Cipher
{
    protected int $shift;

    public function __construct(
        protected string $token,
        int              $shift,
    )
    {
        $this->shift = abs($shift);
    }

    public function encrypt(): string
    {
        return $this->process($this->token, $this->shift);
    }

    public function decrypt(): string
    {
        return $this->process($this->token, -1 * $this->shift);
    }

    protected function process(string $text, int $shift): string
    {
        $result = '';
        $shift = $shift % 26;

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (ctype_alpha($char)) {
                $base = ctype_upper($char) ? ord('A') : ord('a');
                $offset = (ord($char) - $base + $shift + 26) % 26;
                $result .= chr($base + $offset);
            } else {
                $result .= $char; // leave numbers, spaces, punctuation
            }
        }

        return $result;
    }
}