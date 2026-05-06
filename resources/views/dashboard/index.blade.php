@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.dashboard') )}}</h1>
        <div class="small text-muted">{{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <div class="row g-4">
        <!-- Blog Posts -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-primary shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1">{{$post_number}}</h3>
                    <p class="mb-0 opacity-75">{{clean( trans('niva-backend.posts') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-newspaper" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('post.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Blog <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-success shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1">{{$project_number}}</h3>
                    <p class="mb-0 opacity-75">{{clean( trans('niva-backend.projects') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-briefcase" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('project.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Portfólio <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Services -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-info shadow-sm border-0 rounded-4 overflow-hidden text-white">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1">{{$service_number}}</h3>
                    <p class="mb-0 opacity-75">{{clean( trans('niva-backend.services') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-concierge-bell" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('service.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Serviços <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-warning shadow-sm border-0 rounded-4 overflow-hidden text-white">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1 text-white">{{$testimonial_number}}</h3>
                    <p class="mb-0 opacity-75 text-white">{{clean( trans('niva-backend.testimonials') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-comment-dots" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('testimonial.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Feedbacks <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Team Members -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-danger shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1">{{$member_number}}</h3>
                    <p class="mb-0 opacity-75">{{clean( trans('niva-backend.members') )}}</p>
                </div>
                <div class="icon opacity-25">
                    <i class="fas fa-users" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('member.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Equipe <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Clients -->
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-indigo shadow-sm border-0 rounded-4 overflow-hidden text-white" style="background-color: #6610f2 !important;">
                <div class="inner p-4">
                    <h3 class="fw-bold mb-1 text-white">{{$client_number}}</h3>
                    <p class="mb-0 opacity-75 text-white">{{clean( trans('niva-backend.clients') )}}</p>
                </div>
                <div class="icon opacity-25 text-white">
                    <i class="fas fa-handshake" style="font-size: 70px;"></i>
                </div>
                <a href="{{route('client.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover py-2 bg-dark bg-opacity-10">
                    Gerenciar Clientes <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
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
