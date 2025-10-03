#!/bin/bash

if [[ -f .nvmrc ]]; then
    # Load NVM
    source ~/.nvm/nvm.sh

    # Get the desired Node.js version
    NVMRC_V=$(cat .nvmrc)

    echo "Changing Node.js version to $NVMRC_V"
    nvm use "$NVMRC_V" --silent || nvm install "$NVMRC_V"
fi

/usr/bin/php8.3 artisan inertia:start-ssr
