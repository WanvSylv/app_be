@extends('layouts.template')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="card">
    <div class="card-header">
    <h2 class="mb-4 fw-semibold text-primary text-center">Statistiques des abonnements</h2>
</div>
</div>
<div class="container">
    <div class="row g-4 mb-5">
        <!-- Total des abonnements -->
        <div class="col-md-4">
            <a href="{{ route('abonnements.index') }}" class="text-decoration-none">
                <div class="card shadow border-0 h-100 hover-shadow">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted mb-2">
                            <i class="fas fa-users me-2"></i>Total des abonnements
                        </h6>
                        <h2 class="fw-bold text-primary">{{ $totalAbonnements }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Abonnements actifs -->
        <div class="col-md-4">
            <a href="{{ route('abonnements.actifs') }}" class="text-decoration-none">
                <div class="card shadow border-0 h-100 hover-shadow">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>Abonnements actifs
                        </h6>
                        <h2 class="fw-bold text-success">{{ $actifs }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Abonnements expirés -->
        <div class="col-md-4">
            <a href="{{ route('abonnements.expires') }}" class="text-decoration-none">
                <div class="card shadow border-0 h-100 hover-shadow">
                    <div class="card-body text-center">
                        <h6 class="card-title text-muted mb-2">
                            <i class="fas fa-times-circle text-danger me-2"></i>Abonnements expirés
                        </h6>
                        <h2 class="fw-bold text-danger">{{ $expirés }}</h2>
                    </div>
                </div>
            </a>
        </div>
    </div> 
</div>

 @hasanyrole(['SuperAdmin', 'AdminGodomey'])
<div class="container">
    <!-- Abonnements actifs à Godomey -->
<div class="row g-4 mb-5">
<div class="col-md-6 mt-1">
    <div class="card shadow border-0 h-100 hover-shadow mt-1">
        <div class="card-body text-center">
            <h6 class="card-title text-muted mb-2">
                <i class="fas fa-check-circle text-success me-2"></i>Actifs à Godomey
            </h6>
            <h2 class="fw-bold text-success">{{ $actifsParVille['Godomey'] ?? 1 }}</h2>
        </div>
    </div>
</div>

    <!-- Abonnements expirés à Godomey -->
<div class="col-md-6">
    <div class="card shadow border-0 h-100 hover-shadow mt-1">
        <div class="card-body text-center">
            <h6 class="card-title text-muted mb-2">
                <i class="fas fa-times-circle text-danger me-2"></i>Expirés à Godomey
            </h6>
            <h2 class="fw-bold text-danger">{{ $expiresParVille['Godomey'] ?? 0 }}</h2>
        </div>
    </div>
</div>
</div>
@endhasanyrole

 @hasanyrole(['SuperAdmin', 'AdminCalavi'])
<!-- Abonnements actifs à Calavi -->
<div class="row g-4 mb-5">
    <div class="col-md-6 mt-1">
    <div class="card shadow border-0 h-100 hover-shadow">
        <div class="card-body text-center">
            <h6 class="card-title text-muted mb-2">
                <i class="fas fa-check-circle text-primary me-2"></i>Actifs à Calavi
            </h6>
            <h2 class="fw-bold text-primary">{{ $actifsParVille['Calavi'] ?? 2 }}</h2>
        </div>
    </div>
</div>

<!-- Abonnements expirés à Calavi -->
<div class="col-md-6 mt-1">
    <div class="card shadow border-0 h-100 hover-shadow">
        <div class="card-body text-center">
            <h6 class="card-title text-muted mb-2">
                <i class="fas fa-times-circle text-warning me-2"></i>Expirés à Calavi
            </h6>
            <h2 class="fw-bold text-warning">{{ $expiresParVille['Calavi'] ?? 0 }}</h2>
        </div>
    </div>
</div>
@endhasanyrole
 @role('SuperAdmin')
<div class="card shadow-sm border-0 rounded-4 mt-4">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                <i class="bi bi-bar-chart-line-fill fs-3 text-primary"></i>
            </div>
            <h4 class="mb-0 fw-semibold text-primary">Statistiques des abonnements</h4>
        </div>
        <div style="position: relative; width: 2500px; height: 300px;">
            <canvas id="abonnementsChart"></canvas>
        </div>
    </div>
</div>
@endrole

    <!-- Abonnements expirant bientôt -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white fw-bold">Abonnements expirant dans 7 jours</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Bibliothèque</th>
                                    <th>Date d'expiration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($abonnementsBientotExpirés as $abonnement)
                                    <tr>
                                        <td>{{ optional($abonnement->abonne)->nom }} {{ optional($abonnement->abonne)->prenom }}</td>
                                        <td>{{ optional($abonnement->bibliotheque)->nom }}</td>
                                        <td>{{ $abonnement->date_fin->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Aucun abonnement n’expire bientôt.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @role('SuperAdmin')
    <!-- Abonnements par bibliothèque -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white fw-bold">Répartition par bibliothèque</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($abonnementsParBibliotheque as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $data->nom }} - {{ $data->ville }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $data->total }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">Aucune donnée disponible.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endrole
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('abonnementsChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode([
                'Total abonnements',
                'Actifs',
                'Expirés',
                'Expirés Godomey',
                'Expirés Calavi',
                'Actifs Godomey',
                'Actifs Calavi'
            ]) !!},
            datasets: [{
                label: 'Nombre',
                data: {!! json_encode([
                    $totalAbonnements,
                    $actifs,
                    $expirés,
                    $expiresParVille['Godomey'] ?? 0,
                    $expiresParVille['Calavi'] ?? 0,
                    $actifsParVille['Godomey'] ?? 0,
                    $actifsParVille['Calavi'] ?? 0
                ]) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#e74a3b',
                    '#f6c23e', '#f6c23e', '#36b9cc', '#36b9cc'
                ],
                borderColor: '#ccc',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Statistiques des abonnements'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
