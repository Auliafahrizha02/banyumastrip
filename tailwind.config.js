import defaultTheme from 'tailwindcss/defaultTheme'

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2563eb',
                secondary: '#1e40af',
                accent: '#f59e0b',
            },
        },
    },
    plugins: [],
}
