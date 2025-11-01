// assets/js/main.js
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('menu-btn');
  const menu = document.getElementById('menu');
  if (btn && menu) {
    btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    // Cerrar al hacer click fuera
    document.addEventListener('click', (e) => {
      if (!menu.contains(e.target) && !btn.contains(e.target)) {
        if (!menu.classList.contains('hidden')) menu.classList.add('hidden');
      }
    });
  }
});
