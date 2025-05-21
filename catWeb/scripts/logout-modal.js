const open = document.getElementById('logout');
const modal_container = document.getElementById('modal-logout');
const close = document.getElementById('close-logout');

open.addEventListener('click', () => {
    modal_container.classList.add('show');
});

close.addEventListener('click', () => {
    modal_container.classList.remove('show');
});