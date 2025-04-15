
<div class="container-fluid px-4 my-4" style="margin-top: 90px!important;">
    <!-- En-tête du tableau de bord -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3">Tableau de bord administrateur</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" data-mdb-toggle="tooltip" title="Actualiser les données">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="btn-group shadow-0">
                <button class="btn btn-link text-dark" data-mdb-toggle="tooltip" title="Mode clair/sombre">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal text-muted mb-2">Utilisateurs actifs</h6>
                            <h4 class="mb-0">1,245</h4>
                            <div class="small text-success mt-2">
                                <i class="fas fa-angle-up"></i> +5% cette semaine
                            </div>
                        </div>
                        <div class="avatar-md bg-primary-subtle rounded p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal text-muted mb-2">Défis en cours</h6>
                            <h4 class="mb-0">42</h4>
                            <div class="small text-danger mt-2">
                                <i class="fas fa-angle-down"></i> -2% cette semaine
                            </div>
                        </div>
                        <div class="avatar-md bg-info-subtle rounded p-3">
                            <i class="fas fa-trophy fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal text-muted mb-2">Matchs aujourd'hui</h6>
                            <h4 class="mb-0">12</h4>
                            <div class="small text-success mt-2">
                                <i class="fas fa-angle-up"></i> +8% cette semaine
                            </div>
                        </div>
                        <div class="avatar-md bg-warning-subtle rounded p-3">
                            <i class="fas fa-gamepad fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-normal text-muted mb-2">Notifications</h6>
                            <h4 class="mb-0">28</h4>
                            <div class="small text-muted mt-2">
                                Dernière heure
                            </div>
                        </div>
                        <div class="avatar-md bg-success-subtle rounded p-3">
                            <i class="fas fa-bell fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et tableaux -->
    <div class="row g-4 mb-4">
        <!-- Graphique d'activité -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-0">Statistiques d'utilisation</h5>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select">
                                <option value="7">7 derniers jours</option>
                                <option value="15">15 derniers jours</option>
                                <option value="30">30 derniers jours</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Logs système -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Logs système</h5>
                        <button class="btn btn-sm btn-link text-muted" data-mdb-toggle="tooltip" title="Exporter les logs">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="height: 300px;">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr class="text-danger">
                                    <td class="border-0">Erreur d'authentification</td>
                                    <td class="text-end border-0"><small class="text-muted">Il y a 5 min</small></td>
                                </tr>
                                <tr>
                                    <td class="border-0">Nouvelle inscription</td>
                                    <td class="text-end border-0"><small class="text-muted">Il y a 12 min</small></td>
                                </tr>
                                <tr>
                                    <td class="border-0">Mise à jour système</td>
                                    <td class="text-end border-0"><small class="text-muted">Il y a 25 min</small></td>
                                </tr>
                                <tr class="text-warning">
                                    <td class="border-0">Avertissement serveur</td>
                                    <td class="text-end border-0"><small class="text-muted">Il y a 30 min</small></td>
                                </tr>
                                <tr>
                                    <td class="border-0">Nouveau défi créé</td>
                                    <td class="text-end border-0"><small class="text-muted">Il y a 45 min</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gestion des utilisateurs -->
    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-0">Gestion des utilisateurs</h5>
                </div>
                <div class="col-md-8">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div class="input-group w-auto">
                            <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Rechercher">
                            <button class="btn btn-outline-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                </div>
                            </th>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Dernière connexion</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/img/profil.jpg" alt="" style="width: 40px; height: 40px" class="rounded-circle me-3" />
                                    <div>
                                        <h6 class="mb-0">Jean Dupont</h6>
                                        <small class="text-muted">jean.dupont@email.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Administrateur</td>
                            <td><span class="badge bg-success rounded-pill">Actif</span></td>
                            <td>Il y a 2 heures</td>
                            <td>
                                <div class="btn-group shadow-0">
                                    <button class="btn btn-link text-dark" data-mdb-toggle="tooltip" title="Modifier">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn btn-link text-danger" data-mdb-toggle="tooltip" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Ajoutez d'autres lignes d'utilisateurs ici -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-3">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration du graphique d'activité
    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                label: 'Utilisateurs actifs',
                data: [65, 59, 80, 81, 56, 55, 40],
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

    // Initialisation des tooltips
    document.querySelectorAll('[data-mdb-toggle="tooltip"]').forEach(element => {
        new mdb.Tooltip(element);
    });
</script>
