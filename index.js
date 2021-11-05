function initModal(modalID) {
    const modal = document.getElementById(modalID);
    if(modal) {
    modal.classList.add('show');
    modal.addEventListener('click', (event) => {
        if(event.target.id == modalID || event.target.className == 'close') {
            modal.classList.remove('show');
        }
    });
}
}

const buttonModal = document.querySelector('#openModal');
buttonModal.addEventListener('click', () => initModal('modalTools'));