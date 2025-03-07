#!/bin/bash

docker compose up -d

// composer
// baixar tudo
curl -sS https://get.symfony.com/cli/installer | bash
export PATH="$HOME/.symfony5/bin:$PATH"