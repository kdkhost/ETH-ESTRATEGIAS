@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.create_project') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_projectpage') )}}
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0 rounded-4 overflow-hidden">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Novo Projeto Premium</h6>
            @if (!empty($langs))
                <select name="language" class="form-select form-select-sm language-control ms-auto shadow-sm" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                    <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="language_id" value="{{$lang_id}}">

                <div class="row g-4">
                    <!-- Informações Básicas -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Título do Projeto</label>
                        <input type="text" name="title" class="form-control" placeholder="Ex: Portal de Notícias ETH" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">URL Amigável (Slug)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted small">{{URL::to('/')}}/project/</span>
                            <input type="text" name="slug" class="form-control" placeholder="meu-novo-projeto">
                        </div>
                    </div>

                    <!-- Mídia Principal -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-4 p-3">
                            <label class="form-label fw-bold d-block mb-3">{{clean( trans('niva-backend.photo') )}} Principal</label>
                            <input type="file" name="photo_id" class="form-control">
                            <small class="text-muted d-block mt-2">Envie uma imagem chamativa para a capa.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-4 p-3 h-100">
                            <label class="form-label fw-bold d-block mb-3">Imagem de Destaque (URL)</label>
                            <input type="text" name="image_featured2" class="form-control" placeholder="https://exemplo.com/imagem.jpg">
                            <small class="text-muted d-block mt-2">Ou utilize o link de uma imagem do Media Center.</small>
                        </div>
                    </div>

                    <!-- Categoria e Descrição Curta -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.categories') )}}</label>
                        <select name="project_category_id" id="project_category_id" class="form-select" required>
                            <option value="" selected disabled>{{clean( trans('niva-backend.choose_category') )}}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Resumo / Excerpt</label>
                        <textarea name="body" class="form-control" rows="1" placeholder="Pequena introdução do projeto"></textarea>
                    </div>

                    <!-- Conteúdo Rico -->
                    <div class="col-12">
                        <label class="form-label fw-bold">Conteúdo Completo do Projeto</label>
                        <textarea name="excerpt" class="form-control summernote" rows="15"></textarea>
                    </div>

                    <!-- Galeria de Imagens -->
                    <div class="col-12">
                        <h6 class="fw-bold text-muted border-bottom pb-2 mb-3 mt-2">Galeria de Fotos (URLs)</h6>
                        <div class="row g-3">
                            @for ($i = 1; $i <= 4; $i++)
                            <div class="col-md-3">
                                <div class="bg-light p-2 rounded border">
                                    <input type="text" name="img_gal{{$i}}" class="form-control form-control-sm" placeholder="Link da Foto {{$i}}">
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Informações do Cliente -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.duration_project') )}}</label>
                        <input type="text" name="date" class="form-control" placeholder="Ex: Março 2024">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.client') )}}</label>
                        <input type="text" name="client" class="form-control" placeholder="Nome do Cliente">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Botão de Ação</label>
                        <div class="input-group">
                            <input type="text" name="button_text" class="form-control" placeholder="Texto">
                            <input type="text" name="button_link" class="form-control" placeholder="Link">
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="col-12">
                        <div class="card text-bg-primary border-0 rounded-4 shadow-sm overflow-hidden mt-2">
                            <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                                <h6 class="m-0 fw-bold"><i class="fas fa-search me-2"></i> Configurações de SEO (Google)</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75">Meta Título</label>
                                        <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Título SEO">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75">Meta Descrição</label>
                                        <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Descrição SEO">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow rounded-pill">
                            <i class="fas fa-rocket me-2"></i> CRIAR PROJETO AGORA
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('styles')
<style>
    .rounded-4 { border-radius: 1rem !important; }
    .form-label { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; color: #6c757d; }
    .form-control, .form-select { border-radius: 0.5rem; padding: 0.6rem 1rem; border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    .card-header { background-color: #f8f9fa; }
    [data-bs-theme="dark"] .card-header { background-color: rgba(255,255,255,0.05); }
    [data-bs-theme="dark"] .text-white { color: #fff !important; }
</style>
@stop
