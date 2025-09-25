# Cipherio

# Installation

This package can be installed by using
```shell
composer require proteancode/cipherio
```

However since it isn't published on packagist, you may need to add a VCS repository to `composer.json`

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/ProteanCode/cipherio"
    }
],
```

## Usage

The package comes with helper methods that wraps underlying classes:

### Caesar

 The Caesar cipher works by **shifting each letter of the plaintext by a fixed number of positions
 down or up the alphabet**. The shift value, often called the "key," determines how many positions
 each letter is moved. For example, with a shift of 3:

- `caesar_encrypt('hello', 3)`
- `caesar_decrypt('ifmmp', 3)`

### Atbash

The Atbash Cipher is a classical substitution cipher that dates back to the Hebrew script
and is one of the simplest forms of encryption. Unlike the Caesar cipher, which shifts
letters by a fixed number of positions, the Atbash cipher **reverses the alphabet**.
 
- `atbash_encrypt('AZ')`
- `atbash_decrypt('ZA')`

### Bacon

The Bacon Cipher is a classical substitution cipher invented by Francis Bacon in the early 17th century.
It encodes each letter of the alphabet into a sequence of five characters, traditionally represented
as 'A' and 'B'. This means that each letter in a plaintext message is replaced with a unique 5-character
code. For example, the letter 'A' is represented as 'AAAAA', 'B' as 'AAAAB', 'C' as 'AAABA', and so on.

- `bacon_encrypt('CA')`
- `bacon_decrypt('AABAAAAAA')`

## Testing

Tests are being executed using `composer test` command

```shell
docker run --rm --name cipherio -v $(pwd):/app -w /app composer:2.8.12 composer test
```