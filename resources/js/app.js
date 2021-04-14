require('alpinejs')

class Wire {
    watching = {};

    watch(name) {
        const element = document.querySelector('input[name="' + name + '"]')
        element.addEventListener('input', (e) => {

        })
        return this
    }


}

window.Wire = new Wire()
