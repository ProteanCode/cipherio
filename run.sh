#!/bin/bash

# docker run --rm --name cipherio -v $(pwd):/app -w /app composer:2.8.12 composer install
# docker run --rm --name cipherio -v $(pwd):/app -w /app composer:2.8.12 composer du
# docker run --rm --name cipherio -v $(pwd):/app -w /app composer:2.8.12 php index.php

docker run --rm --name cipherio -v $(pwd):/app -w /app composer:2.8.12 composer test
