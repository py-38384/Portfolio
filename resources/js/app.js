import Swal from 'sweetalert2'
import Alpine from 'alpinejs'

import './bootstrap'
import './editorConfig.js'
import './colorPicker.js'

window.Swal = Swal

window.Alpine = Alpine

Alpine.start()

document.querySelectorAll('a[href^="."]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault()
        const targetClass = this.getAttribute('href')
        const target = document.querySelector(targetClass)
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' })
        }
    });
});