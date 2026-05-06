@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.dashboard') )}}</h1>
        <div class="small text-muted">{{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="row g-4">
        <!-- Visitas Hoje -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-primary-subtle text-primary">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3">Hoje</span>
                    </div>
                    <h3 id="dash-visits-count">--</h3>
                    <p class="text-label mb-0">Visitas no Site</p>
                </div>
            </div>
        </div>

        <!-- Mídias Totais -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-info-subtle text-info">
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                    <h3>{{$media_number}}</h3>
                    <p class="text-label mb-0">Arquivos na Mídia</p>
                </div>
            </div>
        </div>

        <!-- Usuários -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-warning-subtle text-warning">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <h3>{{$user_number}}</h3>
                    <p class="text-label mb-0">Usuários do Painel</p>
                </div>
            </div>
        </div>

        <!-- Idiomas Ativos -->
        <div class="col-xl-3 col-md-6">
            <div class="card gourmet-card-light h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-shape bg-indigo-subtle text-indigo" style="color: #6610f2 !important; background-color: #e7d9ff !important;">
                            <i class="fas fa-language"></i>
                        </div>
                    </div>
                    <h3>3</h3>
                    <p class="text-label mb-0">Idiomas Ativos</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mt-1">
        <!-- Blog Posts -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-blue">
                <div class="inner">
                    <h3>{{$post_number}}</h3>
                    <p>{{clean( trans('niva-backend.posts') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{route('post.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-green">
                <div class="inner">
                    <h3>{{$project_number}}</h3>
                    <p>{{clean( trans('niva-backend.projects') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{route('project.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Services -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-cyan">
                <div class="inner">
                    <h3>{{$service_number}}</h3>
                    <p>{{clean( trans('niva-backend.services') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <a href="{{route('service.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-orange">
                <div class="inner">
                    <h3>{{$testimonial_number}}</h3>
                    <p>{{clean( trans('niva-backend.testimonials') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <a href="{{route('testimonial.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Team Members -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-red">
                <div class="inner">
                    <h3>{{$member_number}}</h3>
                    <p>{{clean( trans('niva-backend.members') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('member.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box gourmet-box bg-gourmet-indigo">
                <div class="inner">
                    <h3>{{$client_number}}</h3>
                    <p>{{clean( trans('niva-backend.clients') )}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <a href="{{route('client.index')}}" class="small-box-footer">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>




    <!-- Ações Rápidas do Sistema -->
    <div class="row mt-4 mb-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark"><i class="fas fa-server text-primary me-2"></i> Operações do Sistema</h5>
                        <p class="text-muted small mb-0">Ferramentas de manutenção e otimização rápida de performance.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" id="dash-clear-cache" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">
                            <i class="fas fa-broom me-2"></i> Limpar Cache Total
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Card -->
    <div class="card border-0 shadow-sm rounded-4 mt-5">
        <div class="card-header bg-white border-0 py-3">
            <h6 class="m-0 font-weight-bold text-primary">Resumo do Sistema</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Módulo</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Última Atividade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-medium">Blog</td>
                            <td><span class="badge bg-success-subtle text-success px-3">Ativo</span></td>
                            <td class="text-end pe-4 text-muted small">{{ now()->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Portfólio</td>
                            <td><span class="badge bg-success-subtle text-success px-3">Ativo</span></td>
                            <td class="text-end pe-4 text-muted small">{{ now()->subHours(2)->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Mídia Center</td>
                            <td><span class="badge bg-primary-subtle text-primary px-3">Operacional</span></td>
                            <td class="text-end pe-4 text-muted small">{{ now()->subDays(1)->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
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

