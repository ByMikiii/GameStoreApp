/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "bg-color": "var(--bgcolor)",
                "tx-color": "var(--txcolor)",
                "scnd-color": "var(--scndcolor)",
                "link-color": "var(--linkcolor)",
            },
        },
    },
    plugins: [require("tailwind-scrollbar")],
};
