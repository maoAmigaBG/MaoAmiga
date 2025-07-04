/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', 'Arial'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}