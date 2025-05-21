document.addEventListener('DOMContentLoaded', () => {

const modal = document.getElementById('modal-preview');
const previewContent = document.getElementById('preview-content');
const closeBtn = document.getElementById('close-preview');

function showFilePreview(filePath) {
    previewContent.innerHTML = '';

    const ext = filePath.split('.').pop().toLowerCase();

    if (['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp'].includes(ext)) {
    const img = document.createElement('img');
    img.src = filePath;
    img.style.maxWidth = '100%';
    img.style.maxHeight = '70vh';
    previewContent.appendChild(img);
    } else if (ext === 'pdf') {
    const iframe = document.createElement('iframe');
    iframe.src = filePath;
    iframe.style.width = '100%';
    iframe.style.height = '70vh';
    iframe.frameBorder = 0;
    previewContent.appendChild(iframe);
    } else {
    previewContent.textContent = 'Vista previa no disponible para este tipo de archivo.';
    }

    modal.classList.add('show'); // o modal.style.display = 'flex'; según CSS
}

closeBtn.addEventListener('click', () => {
    modal.classList.remove('show'); // o modal.style.display = 'none';
    previewContent.innerHTML = '';
});

// Cerrar modal al hacer click fuera de la caja modal
modal.addEventListener('click', (e) => {
    if (e.target === modal) {
    modal.classList.remove('show');
    previewContent.innerHTML = '';
    }
});

// Hacemos la función global para llamarla desde onclick inline
window.showFilePreview = showFilePreview;

});
