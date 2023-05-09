/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{js,jsx,ts,tsx}",
  ], theme: {
    extend: {
      colors: {
        'primary': {
          'light': '#1E293B',
          DEFAULT: '#0F172A',
        }
      }
    },
  },
  plugins: [],
}
