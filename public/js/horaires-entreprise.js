/**
 * Gestion dynamique des horaires d'entreprise
 */

document.addEventListener('DOMContentLoaded', function() {
    initHoraires();
});

function initHoraires() {
    const joursSemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    
    joursSemaine.forEach(jour => {
        // Gérer le checkbox "Fermé"
        const fermeCheckbox = document.querySelector(`input[name="horaires[${jour}][ferme]"]`);
        if (fermeCheckbox) {
            fermeCheckbox.addEventListener('change', function() {
                togglePlagesContainer(jour, !this.checked);
            });
            
            // Initialiser l'état au chargement
            togglePlagesContainer(jour, !fermeCheckbox.checked);
        }
        
        // Gérer le bouton "Ajouter une plage"
        const ajouterBtn = document.querySelector(`[data-jour="${jour}"] .ajouter-plage`);
        if (ajouterBtn) {
            ajouterBtn.addEventListener('click', function() {
                ajouterPlage(jour);
            });
        }
        
        // Gérer les boutons de suppression existants
        attachSupprimerHandlers(jour);
    });
}

function togglePlagesContainer(jour, enabled) {
    const container = document.querySelector(`[data-jour="${jour}"] .plages-container`);
    const ajouterBtn = document.querySelector(`[data-jour="${jour}"] .ajouter-plage`);
    
    if (container) {
        if (enabled) {
            container.classList.remove('opacity-50', 'pointer-events-none');
            container.querySelectorAll('input').forEach(input => input.disabled = false);
        } else {
            container.classList.add('opacity-50', 'pointer-events-none');
            container.querySelectorAll('input').forEach(input => input.disabled = true);
        }
    }
    
    if (ajouterBtn) {
        ajouterBtn.disabled = !enabled;
        if (enabled) {
            ajouterBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            ajouterBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
}

function ajouterPlage(jour) {
    const container = document.querySelector(`[data-jour="${jour}"] .plages-container`);
    if (!container) return;
    
    const plages = container.querySelectorAll('.plage');
    const index = plages.length;
    
    const plageHtml = `
        <div class="plage flex items-center gap-3 mb-3">
            <div class="flex-1">
                <label class="block text-xs font-bold text-on-surface-variant mb-1">Début</label>
                <input type="time" 
                       name="horaires[${jour}][plages][${index}][debut]" 
                       class="sunken-input w-full px-4 py-2.5 rounded-lg text-on-surface font-medium"
                       required>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-bold text-on-surface-variant mb-1">Fin</label>
                <input type="time" 
                       name="horaires[${jour}][plages][${index}][fin]" 
                       class="sunken-input w-full px-4 py-2.5 rounded-lg text-on-surface font-medium"
                       required>
            </div>
            <button type="button" 
                    class="supprimer-plage mt-6 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-bold"
                    title="Supprimer cette plage">
                <span class="material-symbols-outlined text-[20px]">delete</span>
            </button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', plageHtml);
    attachSupprimerHandlers(jour);
    
    // Ajouter la validation
    const newPlage = container.lastElementChild;
    const debutInput = newPlage.querySelector('input[name*="[debut]"]');
    const finInput = newPlage.querySelector('input[name*="[fin]"]');
    
    if (debutInput && finInput) {
        finInput.addEventListener('change', function() {
            validerPlage(debutInput, finInput);
        });
        debutInput.addEventListener('change', function() {
            validerPlage(debutInput, finInput);
        });
    }
}

function attachSupprimerHandlers(jour) {
    const container = document.querySelector(`[data-jour="${jour}"] .plages-container`);
    if (!container) return;
    
    container.querySelectorAll('.supprimer-plage').forEach(btn => {
        btn.onclick = function() {
            const plage = this.closest('.plage');
            if (plage) {
                // Vérifier qu'il reste au moins une plage si le jour n'est pas fermé
                const fermeCheckbox = document.querySelector(`input[name="horaires[${jour}][ferme]"]`);
                const plages = container.querySelectorAll('.plage');
                
                if (!fermeCheckbox.checked && plages.length === 1) {
                    alert('Vous devez avoir au moins une plage horaire ou marquer le jour comme fermé.');
                    return;
                }
                
                plage.remove();
                reindexPlages(jour);
            }
        };
    });
}

function reindexPlages(jour) {
    const container = document.querySelector(`[data-jour="${jour}"] .plages-container`);
    if (!container) return;
    
    const plages = container.querySelectorAll('.plage');
    plages.forEach((plage, index) => {
        const debutInput = plage.querySelector('input[name*="[debut]"]');
        const finInput = plage.querySelector('input[name*="[fin]"]');
        
        if (debutInput) {
            debutInput.name = `horaires[${jour}][plages][${index}][debut]`;
        }
        if (finInput) {
            finInput.name = `horaires[${jour}][plages][${index}][fin]`;
        }
    });
}

function validerPlage(debutInput, finInput) {
    if (!debutInput.value || !finInput.value) return;
    
    if (debutInput.value >= finInput.value) {
        finInput.setCustomValidity('L\'heure de fin doit être après l\'heure de début');
        finInput.reportValidity();
    } else {
        finInput.setCustomValidity('');
    }
}
