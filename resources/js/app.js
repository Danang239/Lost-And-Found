import './bootstrap'
import '../css/app.css' // Pastikan CSS Tailwind dimuat oleh Vite

import Alpine from 'alpinejs'
import Swal from 'sweetalert2'

window.Alpine = Alpine
Alpine.start()

window.Swal = Swal

// Helper popup global (bisa dipanggil di Blade)
window.showPopup = (icon, title, text, timer = 1000) => {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
    timer: timer,
    timerProgressBar: true,
    showConfirmButton: false,
  })
}
