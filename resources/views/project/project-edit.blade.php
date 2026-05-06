@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_project') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_projectpage') )}}
            </a>
        </div>
    </div>

    @if ($message = Session::get('project_success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0 rounded-4 overflow-hidden">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detalhes do Projeto</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('project.update', $project->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Informações Básicas -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                        <input type="text" name="title" class="form-control" value="{{$project->title}}" placeholder="Ex: Novo Website Corporativo">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted small">{{URL::to('/')}}/project/</span>
                            <input type="text" name="slug" class="form-control" value="{{$project->slug}}" placeholder="slug-do-projeto">
                        </div>
                    </div>

                    <!-- Mídia Principal -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-4 p-3">
                            <label class="form-label fw-bold d-block mb-3">{{clean( trans('niva-backend.photo') )}} Principal</label>
                            <div class="d-flex align-items-center gap-3">
                                <img class="img-thumbnail rounded-3 shadow-sm" width="100" height="100" style="object-fit: cover;" src="{{$project->photo ? asset('images/media/' . $project->photo->file) : asset('img/200x200.png')}}">
                                <div class="flex-grow-1">
                                    <input type="file" name="photo_id" class="form-control form-control-sm">
                                    <small class="text-muted d-block mt-1">Recomendado: 800x600px</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-4 p-3 h-100">
                            <label class="form-label fw-bold d-block mb-3">Imagem de Destaque (URL)</label>
                            <div class="d-flex align-items-center gap-3">
                                <img class="img-thumbnail rounded-3 shadow-sm" width="100" height="100" style="object-fit: cover;" src="{{$project->image_featured2 ? $project->image_featured2 : asset('img/200x200.png')}}">
                                <div class="flex-grow-1">
                                    <input type="text" name="image_featured2" class="form-control form-control-sm" value="{{$project->image_featured2}}" placeholder="https://...">
                                    <small class="text-muted d-block mt-1">Copie a URL do Media Center</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categoria e Descrição Curta -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.categories') )}}</label>
                        <select name="project_category_id" id="project_category_id" class="form-select">
                            @foreach($categories as $category)
                                <option @if($project->project_category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Resumo / Excerpt</label>
                        <textarea name="excerpt" class="form-control" rows="1">{{$project->excerpt}}</textarea>
                    </div>

                    <!-- Conteúdo Rico -->
                    <div class="col-12">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.body') )}}</label>
                        <textarea name="body" class="form-control summernote" id="body" rows="20">{{$project->body}}</textarea>
                    </div>

                    <!-- Galeria de Imagens -->
                    <div class="col-12">
                        <h6 class="fw-bold text-muted border-bottom pb-2 mb-3 mt-2">Galeria do Projeto (URLs Externas)</h6>
                        <div class="row g-3">
                            @for ($i = 1; $i <= 4; $i++)
                            @php $galField = "img_gal$i"; @endphp
                            <div class="col-md-3">
                                <div class="bg-light p-2 rounded border">
                                    <img class="img-fluid rounded mb-2 shadow-sm d-block mx-auto" style="height: 60px; object-fit: cover;" src="{{$project->$galField ? $project->$galField : asset('img/200x200.png')}}">
                                    <input type="text" name="{{$galField}}" class="form-control form-control-sm" value="{{$project->$galField}}" placeholder="URL Imagem {{$i}}">
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Informações do Cliente -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.duration_project') )}}</label>
                        <input type="text" name="date" class="form-control" value="{{$project->date}}" placeholder="Ex: Março 2024">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.client') )}}</label>
                        <input type="text" name="client" class="form-control" value="{{$project->client}}" placeholder="Nome do Cliente">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Botão do Projeto</label>
                        <div class="input-group">
                            <input type="text" name="button_text" class="form-control" value="{{$project->button_text}}" placeholder="Texto">
                            <input type="text" name="button_link" class="form-control" value="{{$project->button_link}}" placeholder="Link">
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="col-12">
                        <div class="card text-bg-dark border-0 rounded-4 shadow-sm overflow-hidden mt-2">
                            <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                                <h6 class="m-0 fw-bold"><i class="fas fa-search me-2"></i> Configurações de SEO</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold opacity-75">Meta Título</label>
                                        <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$project->meta_title}}" placeholder="Título para o Google">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold opacity-75">Meta Descrição</label>
                                        <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$project->meta_description}}" placeholder="Pequena descrição para o Google">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow rounded-pill">
                            <i class="fas fa-save me-2"></i> SALVAR ALTERAÇÕES PREMIUM
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
    .img-thumbnail { border-radius: 0.75rem; }
    .card-header { background-color: #f8f9fa; }
    [data-bs-theme="dark"] .card-header { background-color: rgba(255,255,255,0.05); }
</style>
@stop
