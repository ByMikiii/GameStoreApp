/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        "bg-color": "var(--bgcolor)",
        "tx-color": "var(--txcolor)"
      },
    },
  },
  plugins: [require('tailwind-scrollbar'),],
}
