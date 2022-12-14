/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/js/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
