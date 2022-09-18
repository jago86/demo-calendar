/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ["'Montserrat'", 'sans-serif', ...defaultTheme.fontFamily.sans],
        'lato': ["'Lato'", 'sans-serif', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [],
}
