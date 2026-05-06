@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.about_settings') )}}</h1>
        @if (!empty($langs))
            <select name="language" class="form-select form-select-sm language-control shadow-sm" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                @foreach ($langs as $lang)
                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    @include('includes.form-errors')

    <form action="{{route('about-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Banner Section -->
            <div class="col-12">
                <div class="card shadow border-0 overflow-hidden">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-image me-2"></i> Banner da Página</h6>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img class="img-fluid rounded shadow-sm border" style="max-height: 200px;" src="{{$setting->banner_img ? $setting->banner_img : asset('img/200x200.png')}}" alt="Banner">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">URL da Imagem do Banner</label>
                                    <div class="input-group">
                                        <input type="text" name="banner_img" class="form-control" value="{{$setting->banner_img}}">
                                        <a target="_blank" href="{{route('media.index')}}" class="btn btn-outline-primary">Mídia Center</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Título do Banner</label>
                                        <input type="text" name="banner_title" class="form-control" value="{{$setting->banner_title}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Descrição do Banner</label>
                                        <input type="text" name="banner_desc" class="form-control" value="{{$setting->banner_desc}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Content Section -->
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Conteúdo "Sobre"</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Subtítulo</label>
                                <input type="text" name="about_subtitle" class="form-control" value="{{$setting->about_subtitle}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título Principal</label>
                                <input type="text" name="about_title" class="form-control" value="{{$setting->about_title}}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Descrição Completa</label>
                                <textarea name="about_description" class="form-control summernote" rows="10">{{$setting->about_description}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Texto do Botão</label>
                                <input type="text" name="about_buttontext" class="form-control" value="{{$setting->about_buttontext}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Link do Botão</label>
                                <input type="text" name="about_buttonlink" class="form-control" value="{{$setting->about_buttonlink}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">URL Imagem Lateral</label>
                                <input type="text" name="about_image" class="form-control" value="{{$setting->about_image}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Link Vídeo (YouTube)</label>
                                <input type="text" name="about_ytlink" class="form-control" value="{{$setting->about_ytlink}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 text-end py-3">
                        <button type="submit" class="btn btn-primary shadow-sm px-5">
                            <i class="fas fa-save me-1"></i> {{clean( trans('niva-backend.update') )}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Sub-sections Management -->
    <div class="row g-4 mt-2">
        <!-- Team Members Section -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users me-2"></i> Equipe</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('about-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Título da Seção de Membros</label>
                            <input type="text" name="member_title_section" class="form-control form-control-sm" value="{{$setting->member_title_section}}">
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary w-100 mb-3">Salvar Título</button>
                    </form>
                    <div class="d-grid gap-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('member.index') . '?language=' . request()->input('language')}}">Ver Todos</a>
                        <a class="btn btn-sm btn-light border" href="{{ route('member.create') . '?language=' . request()->input('language')}}">Criar Novo</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-comments me-2"></i> Depoimentos</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-grid gap-2">
                        <a class="btn btn-primary" href="{{ route('testimonial.index') . '?language=' . request()->input('language')}}">Gerenciar Feedbacks</a>
                        <a class="btn btn-light border" href="{{ route('testimonial.create') . '?language=' . request()->input('language')}}">Novo Depoimento</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clients Section -->
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-handshake me-2"></i> Clientes</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-grid gap-2">
                        <a class="btn btn-primary" href="{{ route('client.index') . '?language=' . request()->input('language')}}">Gerenciar Logos</a>
                        <a class="btn btn-light border" href="{{ route('client.create') . '?language=' . request()->input('language')}}">Novo Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Section -->
    <div class="card shadow mb-4 border-0 mt-4">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-search me-2"></i> {{clean( trans('niva-backend.seo') )}}</h6>
        </div>
        <div class="card-body">
            <form action="{{route('about-setting.update', $setting->id)}}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_title') )}}</label>
                        <input type="text" name="meta_title" class="form-control" value="{{$setting->meta_title}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_description') )}}</label>
                        <input type="text" name="meta_description" class="form-control" value="{{$setting->meta_description}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.slug') )}}</label>
                        <input type="text" name="slug" class="form-control" value="{{$setting->slug}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.anchor_text') )}}</label>
                        <input type="text" name="breadcrumbs_anchor" class="form-control" value="{{$setting->breadcrumbs_anchor}}">
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-outline-primary px-5">Atualizar SEO</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('styles')
<style>
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
</style>
@stop