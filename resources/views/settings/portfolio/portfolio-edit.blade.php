@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.portfolio_settings') )}}</h1>
        @if (!empty($langs))
            <select name="language" class="form-select form-select-sm language-control ms-auto shadow-sm" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                @foreach ($langs as $lang)
                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    @if ($message = Session::get('setting_success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('includes.form-errors')

    <div class="row g-4">
        
        <!-- Link para Gerenciar Projetos -->
        <div class="col-12">
            <div class="card shadow border-0 rounded-4 overflow-hidden bg-primary text-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold mb-1"><i class="fas fa-briefcase me-2"></i> Gerenciamento de Projetos</h5>
                        <p class="small mb-0 opacity-75">Crie, edite e organize os projetos que aparecem no seu portfólio.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a class="btn btn-light btn-sm fw-bold px-3 shadow-sm" href="{{ route('project.index') . '?language=' . request()->input('language')}}">Ver Todos</a>
                        <a class="btn btn-light btn-sm fw-bold px-3 shadow-sm" href="{{ route('project.create') . '?language=' . request()->input('language')}}">Novo Projeto</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner e Conteúdo Principal -->
        <div class="col-12">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-image me-2"></i> Banner do Portfólio</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('portfolio-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-lg-4 text-center">
                                <label class="form-label fw-bold d-block mb-3 uppercase small">Visualização do Banner</label>
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 200px; object-fit: cover;" src="{{$setting->banner_img ? $setting->banner_img : asset('img/200x200.png')}}" alt="Banner">
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold small text-muted">URL da Imagem do Banner</label>
                                    <div class="input-group">
                                        <input type="text" name="banner_img" class="form-control" value="{{$setting->banner_img}}" placeholder="https://...">
                                        <a target="_blank" href="{{route('media.index'). '?language=' . request()->input('language')}}" class="btn btn-outline-primary">Mídia Center</a>
                                    </div>
                                    <small class="text-muted mt-1 d-block">Recomendado: 1920x400px para banners hero.</small>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">Título da Página</label>
                                        <input type="text" name="banner_title" class="form-control" value="{{$setting->banner_title}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted">Descrição Curta</label>
                                        <input type="text" name="banner_desc" class="form-control" value="{{$setting->banner_desc}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary px-5 shadow rounded-pill">
                                    <i class="fas fa-save me-2"></i> Atualizar Banner
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div class="col-12">
            <div class="card text-bg-dark border-0 rounded-4 shadow-sm overflow-hidden">
                <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-search me-2"></i> Configurações de SEO (Busca)</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('portfolio-setting.update', $setting->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Título</label>
                                <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->meta_title}}" placeholder="Título para o Google">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Descrição</label>
                                <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->meta_description}}" placeholder="Pequena descrição para o Google">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Slug (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white bg-opacity-10 text-white border-0 small opacity-50">{{URL::to('/')}}/</span>
                                    <input type="text" name="slug" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->slug}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Texto de Breadcrumb</label>
                                <input type="text" name="breadcrumbs_anchor" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->breadcrumbs_anchor}}">
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-light px-5 shadow rounded-pill fw-bold">
                                    <i class="fas fa-search me-2"></i> Atualizar SEO
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('styles')
<style>
    .rounded-4 { border-radius: 1rem !important; }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; }
    .form-control, .form-select, .input-group-text { border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    [data-bs-theme="dark"] .bg-light { background-color: rgba(255,255,255,0.05) !important; }
</style>
@stop