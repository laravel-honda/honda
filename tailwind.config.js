const plugin = require('tailwindcss/plugin')

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './vendor/**/*.blade.php'],
    darkMode: false,
    theme: {
        extend: {
            fontFamily: {
                sans: ['Gilroy', 'sans-serif']
            }
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['active'],
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
        plugin(({addComponents}) => {
            addComponents({
                '.no-scrollbar': {
                    '-ms-overflow-style': 'none',
                    'scrollbar-width': 'none',
                    '&::-webkit-scrollbar': {
                        'display': 'none'
                    }
                }
            });
        }),
    ],
}
