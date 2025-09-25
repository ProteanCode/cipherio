<?php

namespace ProteanCode\Cipherio\Strategies;

use ProteanCode\Cipherio\Interfaces\Cipher;

/**
 * The Bacon Cipher is a classical substitution cipher invented by Francis Bacon in the early 17th century.
 * It encodes each letter of the alphabet into a sequence of five characters, traditionally represented
 * as 'A' and 'B'. This means that each letter in a plaintext message is replaced with a unique 5-character
 * code. For example, the letter 'A' is represented as 'AAAAA', 'B' as 'AAAAB', 'C' as 'AAABA', and so on.
 *
 * Key characteristics of the Bacon cipher:
 *
 * 1. **Fixed-length encoding:** Every letter, regardless of its position, is encoded into exactly five symbols.
 * This makes the encoded message uniform and easier to conceal.
 *
 * 2. **Case-insensitive:** Typically, uppercase and lowercase letters are treated the same. Only letters
 * are encoded; numbers, spaces, and punctuation can be ignored or left unchanged.
 *
 * 3. **I/J and U/V combinations:** In the original Bacon cipher, the 26-letter English alphabet is mapped
 * onto 24 code sequences, combining 'I' and 'J' as well as 'U' and 'V' to fit the 5-bit encoding scheme.
 *
 * 4. **Symmetry in encoding/decoding:** Using the predefined mapping of letters to 'A'/'B' sequences,
 * it is straightforward to encode plaintext into cipher text and to decode cipher text back to plaintext.
 *
 * 5. **Steganographic potential:** The sequences of 'A' and 'B' can be hidden in other media, such as
 * typography or spacing in a text, making the Bacon cipher not only a substitution cipher but also
 * a tool for hidden messages.
 *
 * Example:
 * Plaintext: "HELLO"
 * Encoding:
 * H -> AABBB
 * E -> AABAA
 * L -> ABABA
 * L -> ABABA
 * O -> ABBAB
 * Encoded message: "AABBB AABAA ABABA ABABA ABBAB"
 *
 * Decoding is simply the reverse process:
 * Take every 5-character sequence of 'A' and 'B', and map it back to the corresponding letter.
 *
 * The Bacon cipher is not secure by modern cryptographic standards, but it is historically significant
 * and useful for educational purposes, illustrating the concept of substitution ciphers and
 * early cryptographic thinking.
 */
class BaconStrategy implements Cipher
{
    protected readonly array $baconMap;

    protected readonly array $reverseMap;

    public function __construct(
        protected string $token,
    )
    {
        $this->token = strtoupper($this->token);

        $this->baconMap = [
            'A' => 'AAAAA', 'B' => 'AAAAB', 'C' => 'AAABA', 'D' => 'AAABB', 'E' => 'AABAA',
            'F' => 'AABAB', 'G' => 'AABBA', 'H' => 'AABBB', 'I' => 'ABAAA', 'J' => 'ABAAA',
            'K' => 'ABAAB', 'L' => 'ABABA', 'M' => 'ABABB', 'N' => 'ABBAA', 'O' => 'ABBAB',
            'P' => 'ABBBA', 'Q' => 'ABBBB', 'R' => 'BAAAA', 'S' => 'BAAAB', 'T' => 'BAABA',
            'U' => 'BAABB', 'V' => 'BAABB', 'W' => 'BABAA', 'X' => 'BABAB', 'Y' => 'BABBA',
            'Z' => 'BABBB'
        ];

        $this->reverseMap = array_flip($this->baconMap);
    }

    public function encrypt(): string
    {
        $text = strtoupper($this->token);
        $result = '';

        foreach (str_split($text) as $char) {
            if (ctype_alpha($char)) {
                $result .= $this->baconMap[$char];
            }
        }

        return $result;
    }

    public function decrypt(): string
    {
        $code = strtoupper(preg_replace('/[^AB]/i', '', $this->token)); // remove invalid chars
        $result = '';

        for ($i = 0; $i < strlen($code); $i += 5) {
            $chunk = substr($code, $i, 5);
            if (isset($this->reverseMap[$chunk])) {
                $result .= $this->reverseMap[$chunk];
            }
        }

        return $result;
    }
}