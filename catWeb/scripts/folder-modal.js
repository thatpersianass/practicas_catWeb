const open = document.getElementById('add-folder');
const modal_container = document.getElementById('modal-add-folder');
const close = document.getElementById('close');

open.addEventListener('click', () => {
    modal_container.classList.add('show');
});

close.addEventListener('click', () => {
    modal_container.classList.remove('show');
});