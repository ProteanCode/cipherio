#!/bin/bash

docker run --rm --name cipherio -v $(pwd):/app -w /app php:8.4-cli-alpine3.22 php index.php
