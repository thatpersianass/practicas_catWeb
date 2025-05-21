const open = document.getElementById('user-create');
const modal_container = document.getElementById('modal-add-user');
const close = document.getElementById('close');

open.addEventListener('click', () => {
    modal_container.classList.add('show');
});

close.addEventListener('click', () => {
    modal_container.classList.remove('show');
});