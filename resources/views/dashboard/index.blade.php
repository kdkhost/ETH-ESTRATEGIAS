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
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle bg-primary-subtle p-3 text-primary">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3">Hoje</span>
                    </div>
                    <h3 class="fw-bold mb-1" id="dash-visits-count">--</h3>
                    <p class="text-muted small mb-0">Visitas no Site</p>
                </div>
            </div>
        </div>

        <!-- Mídias Totais -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle bg-info-subtle p-3 text-info">
                            <i class="fas fa-images fa-lg"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1">{{$media_number}}</h3>
                    <p class="text-muted small mb-0">Arquivos na Mídia</p>
                </div>
            </div>
        </div>

        <!-- Usuários -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle bg-warning-subtle p-3 text-warning">
                            <i class="fas fa-user-shield fa-lg"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1">{{$user_number}}</h3>
                    <p class="text-muted small mb-0">Usuários do Painel</p>
                </div>
            </div>
        </div>

        <!-- Idiomas Ativos -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="rounded-circle bg-indigo-subtle p-3 text-indigo" style="color: #6610f2; background-color: #e7d9ff;">
                            <i class="fas fa-language fa-lg"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1">3</h3>
                    <p class="text-muted small mb-0">Idiomas Ativos</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <!-- Blog Posts -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-primary shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0" style="font-size: 1.75rem;">{{$post_number}}</h3>
                    <p class="mb-0 opacity-75 small">{{clean( trans('niva-backend.posts') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-newspaper" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('post.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-success shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0" style="font-size: 1.75rem;">{{$project_number}}</h3>
                    <p class="mb-0 opacity-75 small">{{clean( trans('niva-backend.projects') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-briefcase" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('project.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Services -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-info shadow-sm border-0 rounded-4 overflow-hidden text-white">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0 text-white" style="font-size: 1.75rem;">{{$service_number}}</h3>
                    <p class="mb-0 opacity-75 text-white small">{{clean( trans('niva-backend.services') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-concierge-bell" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('service.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-warning shadow-sm border-0 rounded-4 overflow-hidden text-white">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0 text-white" style="font-size: 1.75rem;">{{$testimonial_number}}</h3>
                    <p class="mb-0 opacity-75 text-white small">{{clean( trans('niva-backend.testimonials') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-comment-dots" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('testimonial.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Team Members -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-danger shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0" style="font-size: 1.75rem;">{{$member_number}}</h3>
                    <p class="mb-0 opacity-75 small">{{clean( trans('niva-backend.members') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-users" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('member.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
                    Gerenciar <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="small-box text-bg-indigo shadow-sm border-0 rounded-4 overflow-hidden text-white" style="background-color: #6610f2 !important;">
                <div class="inner p-3">
                    <h3 class="fw-bold mb-0 text-white" style="font-size: 1.75rem;">{{$client_number}}</h3>
                    <p class="mb-0 opacity-75 text-white small">{{clean( trans('niva-backend.clients') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-handshake" style="font-size: 50px; top: 15px;"></i>
                </div>
                <a href="{{route('client.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-1 bg-dark bg-opacity-10 text-center d-block small">
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

