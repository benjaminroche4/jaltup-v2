/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'main':'#774cff',
        'main-strong':'#471dd0',
        'pastel-light': '#FFF5F1',
        'gray-custom': '#F0F3F4',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

