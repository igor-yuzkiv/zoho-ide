/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
    ],
    darkMode: 'class',
    theme: {
        colors: {},
        extend: {},
        fontFamily: {},
    },
    plugins: [
        require('flowbite/plugin')
    ]
}

