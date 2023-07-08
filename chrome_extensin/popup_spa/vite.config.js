import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import {
    fileURLToPath,
    URL
} from 'node:url'


// https://vitejs.dev/config/
export default defineConfig({
    plugins: [vue()],
    base   : '',
    define : {'process.env': {}},
    resolve: {
        alias     : {
            '@': fileURLToPath(new URL('./src', import.meta.url))
        },
        extensions: [
            '.js',
            '.json',
            '.jsx',
            '.mjs',
            '.ts',
            '.tsx',
            '.vue',
        ],
    },
    server : {
        port: 3000,
        proxy: {
            "/api": {
                target: "https://store.igoryuzkiv.tech",
                changeOrigin: true,
                rewrite: (path) => path.replace(/^\/api/, ''),
            }
        },
    }
})
