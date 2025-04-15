// Gestion du thème clair/sombre
const themeToggler = document.querySelector('[title="Mode clair/sombre"]');
const body = document.body;

themeToggler.addEventListener('click', () => {
    body.classList.toggle('dark-theme');
    const isDarkMode = body.classList.contains('dark-theme');
    themeToggler.querySelector('i').classList.toggle('fa-sun', isDarkMode);
    themeToggler.querySelector('i').classList.toggle('fa-moon', !isDarkMode);
    localStorage.setItem('darkMode', isDarkMode);
});

// Restaurer le thème au chargement
document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        body.classList.add('dark-theme');
        themeToggler.querySelector('i').classList.replace('fa-moon', 'fa-sun');
    }
});

// Gestion de la sélection multiple dans le tableau
const checkAll = document.getElementById('checkAll');
const checkboxes = document.querySelectorAll('tbody .form-check-input');

checkAll.addEventListener('change', () => {
    checkboxes.forEach(checkbox => checkbox.checked = checkAll.checked);
});

// Actualisation des données en temps réel
const refreshButton = document.querySelector('[title="Actualiser les données"]');
refreshButton.addEventListener('click', async () => {
    try {
        refreshButton.querySelector('i').classList.add('fa-spin');
        // Simuler une requête API
        await new Promise(resolve => setTimeout(resolve, 1000));
        // Mettre à jour les données ici
        showNotification('Données actualisées avec succès', 'success');
    } catch (error) {
        showNotification('Erreur lors de l\'actualisation', 'error');
    } finally {
        refreshButton.querySelector('i').classList.remove('fa-spin');
    }
});

// Système de notifications
function showNotification(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast position-fixed bottom-0 end-0 m-3 ${type}`;
    toast.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="toast"></button>
        </div>
        <div class="toast-body">${message}</div>
    `;
    document.body.appendChild(toast);
    new mdb.Toast(toast).show();
    setTimeout(() => toast.remove(), 3000);
}

// Gestion de la recherche en temps réel
const searchInput = document.querySelector('input[placeholder="Rechercher..."]');
const tableRows = document.querySelectorAll('tbody tr');

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Gestion des actions sur les utilisateurs
document.querySelectorAll('.btn-group .btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const action = e.currentTarget.getAttribute('title');
        const userRow = e.currentTarget.closest('tr');
        const userName = userRow.querySelector('h6').textContent;

        if (action === 'Modifier') {
            // Implémenter la logique de modification
            showNotification(`Modification de l'utilisateur ${userName}`, 'info');
        } else if (action === 'Supprimer') {
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur ${userName} ?`)) {
                // Implémenter la logique de suppression
                showNotification(`Utilisateur ${userName} supprimé`, 'warning');
                userRow.remove();
            }
        }
    });
});

// Mise à jour automatique du graphique
let activityChart;
document.querySelector('select.form-select').addEventListener('change', (e) => {
    const days = parseInt(e.target.value);
    updateChart(days);
});

function updateChart(days) {
    // Simuler la récupération de données
    const data = Array.from({length: days}, () => Math.floor(Math.random() * 100));
    const labels = Array.from({length: days}, (_, i) => `Jour ${i + 1}`);

    if (activityChart) {
        activityChart.destroy();
    }

    const ctx = document.getElementById('activityChart').getContext('2d');
    activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Utilisateurs actifs',
                data: data,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
}