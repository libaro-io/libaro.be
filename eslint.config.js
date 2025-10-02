import prettier from 'eslint-config-prettier';
import vue from 'eslint-plugin-vue';

import { defineConfigWithVueTs, vueTsConfigs } from '@vue/eslint-config-typescript';

export default defineConfigWithVueTs(
    vue.configs['flat/essential'],
    vueTsConfigs.recommended,
    {
        ignores: [
            'vendor',
            'node_modules',
            'public',
            'bootstrap/ssr',
            'tailwind.config.js',
            'resources/js/components/ui/*',
            'resources/js/components/wayfinder/*',
            'resources/js/routes/**/*.ts',
            'resources/js/actions/**/*.ts',
            'resources/js/wayfinder/**/*.ts',
        ],
    },
    {
        rules: {
            'vue/multi-word-component-names': 'off',
            'no-console': 'error',
            '@typescript-eslint/explicit-function-return-type': 'error',
        },
    },
    prettier,
);
