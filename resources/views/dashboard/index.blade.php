@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.dashboard') )}}</h1>
        <div class="small text-muted">{{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Visitas Hoje -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-primary-subtle text-primary rounded-4" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 small fw-bold">Live</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h2 class="fw-extrabold mb-0" id="dash-visits-count" style="font-size: 2.2rem; letter-spacing: -1px;">--</h2>
                        <span class="text-success small fw-bold"><i class="fas fa-arrow-up me-1"></i>Hoje</span>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mt-1 mb-0 opacity-75" style="letter-spacing: 1px;">Visitas Únicas</p>
                </div>
            </div>
        </div>

        <!-- Mídias Totais -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-info-subtle text-info rounded-4" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-images fa-lg"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h2 class="fw-extrabold mb-0" style="font-size: 2.2rem; letter-spacing: -1px;">{{$media_number}}</h2>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mt-1 mb-0 opacity-75" style="letter-spacing: 1px;">Arquivos em Nuvem</p>
                </div>
            </div>
        </div>

        <!-- Usuários -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-warning-subtle text-warning rounded-4" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-shield fa-lg"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h2 class="fw-extrabold mb-0" style="font-size: 2.2rem; letter-spacing: -1px;">{{$user_number}}</h2>
                    </div>
                    <p class="text-muted small fw-bold text-uppercase mt-1 mb-0 opacity-75" style="letter-spacing: 1px;">Administradores</p>
                </div>
            </div>
        </div>

        <!-- Saúde do Sistema -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100 border-0 shadow-sm bg-dark text-white overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex align-items-center justify-content-between mb-3 position-relative" style="z-index: 2;">
                        <div class="icon-shape bg-white bg-opacity-10 text-white rounded-4" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-heartbeat fa-lg"></i>
                        </div>
                        <span class="badge bg-primary rounded-pill px-3 py-1 small fw-bold shadow-sm">Online</span>
                    </div>
                    <div class="position-relative" style="z-index: 2;">
                        <h2 class="fw-extrabold mb-0 text-white" style="font-size: 2.2rem; letter-spacing: -1px;">100%</h2>
                        <p class="text-white small fw-bold text-uppercase mt-1 mb-0 opacity-50" style="letter-spacing: 1px;">Uptime Estável</p>
                    </div>
                    <i class="fas fa-shield-alt position-absolute" style="right: -20px; bottom: -20px; font-size: 100px; opacity: 0.05;"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3">
        <!-- Blog Posts -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-blue">
                <div class="inner text-center">
                    <h3>{{$post_number}}</h3>
                    <p>{{clean( trans('niva-backend.posts') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{route('post.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-green">
                <div class="inner text-center">
                    <h3>{{$project_number}}</h3>
                    <p>{{clean( trans('niva-backend.projects') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{route('project.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Services -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-cyan">
                <div class="inner text-center">
                    <h3>{{$service_number}}</h3>
                    <p>{{clean( trans('niva-backend.services') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <a href="{{route('service.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-orange">
                <div class="inner text-center">
                    <h3>{{$testimonial_number}}</h3>
                    <p>{{clean( trans('niva-backend.testimonials') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <a href="{{route('testimonial.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Team Members -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-red">
                <div class="inner text-center">
                    <h3>{{$member_number}}</h3>
                    <p>{{clean( trans('niva-backend.members') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('member.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-indigo">
                <div class="inner text-center">
                    <h3>{{$client_number}}</h3>
                    <p>{{clean( trans('niva-backend.clients') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <a href="{{route('client.index')}}" class="small-box-footer">
                    Acessar <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Ações Rápidas do Sistema -->
    <div class="row mt-5 mb-2">
        <div class="col-lg-8">
            <div class="card gourmet-card-light shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 py-3 ps-4">
                    <h6 class="m-0 font-weight-bold text-dark text-uppercase small opacity-75" style="letter-spacing: 1px;">Últimas Atividades do Sistema</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="bg-light bg-opacity-50">
                                    <th class="ps-4 border-0 small text-uppercase py-3">Módulo</th>
                                    <th class="border-0 small text-uppercase py-3">Status</th>
                                    <th class="text-end pe-4 border-0 small text-uppercase py-3">Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3 fw-bold text-dark small"><i class="fas fa-newspaper text-primary me-2 opacity-50"></i>Blog / Notícias</td>
                                    <td><span class="badge bg-success-subtle text-success px-3 rounded-pill">Ativo</span></td>
                                    <td class="text-end pe-4 text-muted small fw-medium">{{ now()->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-4 py-3 fw-bold text-dark small"><i class="fas fa-briefcase text-success me-2 opacity-50"></i>Portfólio ETH</td>
                                    <td><span class="badge bg-success-subtle text-success px-3 rounded-pill">Ativo</span></td>
                                    <td class="text-end pe-4 text-muted small fw-medium">{{ now()->subHours(2)->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td class="ps-4 py-3 fw-bold text-dark small"><i class="fas fa-photo-video text-info me-2 opacity-50"></i>Mídia Center</td>
                                    <td><span class="badge bg-primary-subtle text-primary px-3 rounded-pill">Operacional</span></td>
                                    <td class="text-end pe-4 text-muted small fw-medium">{{ now()->subDays(1)->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card gourmet-card-light border-0 shadow-lg rounded-4 bg-primary text-white h-100 overflow-hidden">
                <div class="card-body p-4 d-flex flex-column justify-content-center text-center position-relative">
                    <div class="position-relative" style="z-index: 2;">
                        <div class="bg-white rounded-circle p-2 d-inline-block mb-3 shadow-lg border border-4 border-white border-opacity-25">
                            <img src="{{route('home')}}/public/images/media/1705726533logo.png" alt="Logo" style="width: 80px; height: 80px; object-fit: contain;">
                        </div>
                        <h5 class="fw-extrabold mb-2 text-white">Performance ETH</h5>
                        <p class="text-white opacity-75 small mb-4">Mantenha seu sistema sempre rápido limpando caches desatualizados.</p>
                        <button type="button" id="dash-clear-cache" class="btn btn-white btn-lg rounded-pill px-5 shadow fw-bold text-primary hover-scale">
                            <i class="fas fa-broom me-2"></i> LIMPAR TUDO
                        </button>
                    </div>
                    <i class="fas fa-rocket position-absolute" style="left: -30px; top: -30px; font-size: 150px; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

@stop

@section('footer')
<script>
    $(document).ready(function() {
        // Carregar visitas no dashboard
        $.ajax({
            url: '{{ url("/admin/api/visits-today") }}',
            type: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(data) {
                if (data.count !== undefined) {
                    $('#dash-visits-count').text(data.count);
                }
            }
        });

        // Botão de cache no dashboard
        $('#dash-clear-cache').on('click', function() {
            let btn = $(this);
            Swal.fire({
                title: 'Limpar todos os caches?',
                text: 'Config, rotas, views e application cache serão regenerados.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-broom me-1"></i> Sim, limpar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Limpando...');
                    $.ajax({
                        url: '{{ route("system.optimize") }}',
                        type: 'GET',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        success: function() {
                            showToasty('✅ Caches limpos e otimizados com sucesso!', 'success');
                            btn.prop('disabled', false).html('<i class="fas fa-broom me-2"></i> Limpar Cache Total');
                        },
                        error: function() {
                            showToasty('Erro ao limpar cache.', 'error');
                            btn.prop('disabled', false).html('<i class="fas fa-broom me-2"></i> Limpar Cache Total');
                        }
                    });
                }
            });
        });
    });
</script>
@stop

