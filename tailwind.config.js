/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    100: "#E3F8FF",
                    200: "#C6F1FF",
                    300: "#AAEBFF",
                    400: "#8EE4FF",
                    500: "#71DDFF",
                    600: "#55D6FF",
                    700: "#39D0FF",
                    800: "#1CC9FF",
                    900: "#00C2FF",
                },
                indigo: {
                    600: "#00c6ff",
                    800: "#009DFF",
                },
            },
        },
    },
    plugins: [],
};
