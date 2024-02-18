/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontSize: {
              // Tambahkan ukuran font sesuai kebutuhan
            },
            // Tambahkan penyesuaian untuk pseudo-class di sini
            textAdjust: ['responsive', 'hover', 'focus', 'lg'], // Atau gunakan pseudo-class yang sesuai
          },
    },
    plugins: [],
};
