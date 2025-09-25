<?php

namespace ProteanCode\Cipherio\Strategies;

use ProteanCode\Cipherio\Interfaces\Cipher;

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