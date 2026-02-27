#!/bin/sh

export default {
    // eslint-disable-next-line @typescript-eslint/explicit-function-return-type
    "**/*.php": () => {
        return [
            "php vendor/bin/phpstan analyse --memory-limit=2G",
            "php vendor/bin/duster fix --dirty",
        ];
    },
    // eslint-disable-next-line @typescript-eslint/explicit-function-return-type
    "resources/js/**/*.{ts,tsx,vue}": () => {
        return [
            "npm run lint:fix",
        ];
    },
    "(**/*.php|resources/js/**/*.{ts,tsx,vue})": () => {
        return [
            "npx vue-tsc --noEmit",
        ];
    }
};
