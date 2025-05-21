const dropArea = document.getElementById('drop-area');
const inputFile = document.getElementById('input-file');
const dragDrop = document.querySelector('.drag-drop');

inputFile.addEventListener('change', handleFile);

dropArea.addEventListener('dragover', function (e) {
    e.preventDefault();
});

dropArea.addEventListener('drop', function (e) {
    e.preventDefault();

    if (e.dataTransfer.files.length > 0) {
    const dt = new DataTransfer();
    for (const file of e.dataTransfer.files) {
        dt.items.add(file);
    }
    inputFile.files = dt.files;

    handleFile();
    }
});

function handleFile() {
    if (inputFile.files.length === 0) return;

    const file = inputFile.files[0];
    const fileName = file.name;
    const extension = fileName.split('.').pop().toLowerCase();

    const supportedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'csv'];
    const iconPath = supportedExtensions.includes(extension)
    ? `../../icons/${extension}.png`
    : '../../icons/document.png';

    const imgTag = dragDrop.querySelector('img') || document.createElement('img');
    imgTag.src = iconPath;
    if (!dragDrop.contains(imgTag)) dragDrop.prepend(imgTag);

    const pTag = dragDrop.querySelector('p');
    if (pTag) {
    pTag.textContent = `Archivo: ${fileName}`;
    }
}
