/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'merah180-polteka': '#830000',  
        'merah200-polteka': '#620000',
        'merah20-polteka': '#FFCDCD', 
        'biru160-polteka': '#060A6B',
        'biru100-polteka': '#6266C1',
        'hitam-polteka': '#000000', 
        'putih-polteka': '#FFFFFF', 
        'abu-polteka': '#F3F3F4', 
      },
      fontFamily: {
        'polteka': ['Rubik'],
        PlayfairDisplay: ['Playfair Display', 'serif'],
      },
    },
    
  },
  plugins: [],
}

