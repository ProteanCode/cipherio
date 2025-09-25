<?php

namespace ProteanCode\Cipherio\Strategies;

use ProteanCode\Cipherio\Interfaces\Cipher;

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