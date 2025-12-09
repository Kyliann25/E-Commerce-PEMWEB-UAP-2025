import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'hubbub-black': '#111111',
                'hubbub-pink': '#FF00CC',
                'hubbub-gray': '#f5f5f5',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif', ...defaultTheme.fontFamily.sans],
                header: ['Oswald', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
