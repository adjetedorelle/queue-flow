/**
 * Gestion des modals d'horaires
 */

function openHorairesModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Ajouter l'écouteur pour la touche ESC
        document.addEventListener('keydown', handleEscapeKey);
    }
}

function closeHorairesModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        
        // Retirer l'écouteur pour la touche ESC
        document.removeEventListener('keydown', handleEscapeKey);
    }
}

function handleEscapeKey(event) {
    if (event.key === 'Escape') {
        // Fermer tous les modals ouverts
        const openModals = document.querySelectorAll('[id^="modal-horaires-"]:not(.hidden)');
        openModals.forEach(modal => {
            closeHorairesModal(modal.id);
        });
    }
}
