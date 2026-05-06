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

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit me-2"></i>Detalhes do Projeto Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('project.update', $project->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Informações Básicas -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Título do Projeto</label>
                        <input type="text" name="title" class="form-control form-control-lg bg-light border-0 shadow-none" value="{{$project->title}}" placeholder="Ex: Novo Website Corporativo">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">URL Amigável (Slug)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 text-muted small ps-0">{{URL::to('/')}}/project/</span>
                            <input type="text" name="slug" class="form-control form-control-lg bg-light border-0 shadow-none rounded-end" value="{{$project->slug}}" placeholder="slug-do-projeto">
                        </div>
                    </div>

                    <!-- Mídia Principal -->
                    <div class="col-md-6">
                        <div class="card bg-white border shadow-sm rounded-4 p-3 h-100">
                            <label class="form-label fw-bold d-block mb-3 small text-muted uppercase"><i class="fas fa-image me-2"></i>Foto Principal</label>
                            <div class="d-flex align-items-center gap-3">
                                <img loading="lazy" class="rounded-3 shadow-sm border-4 border-white" width="100" height="100" style="object-fit: cover;" src="{{$project->photo ? asset('images/media/' . $project->photo->file) : asset('img/200x200.png')}}">
                                <div class="flex-grow-1">
                                    <input type="file" name="photo_id" class="form-control form-control-sm border-0 bg-light">
                                    <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">Recomendado: 800x600px (JPG/PNG)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-white border shadow-sm rounded-4 p-3 h-100">
                            <label class="form-label fw-bold d-block mb-3 small text-muted uppercase"><i class="fas fa-star me-2"></i>Imagem de Destaque (URL)</label>
                            <div class="d-flex align-items-center gap-3">
                                <img loading="lazy" class="rounded-3 shadow-sm border-4 border-white" width="100" height="100" style="object-fit: cover;" src="{{$project->image_featured2 ? $project->image_featured2 : asset('img/200x200.png')}}">
                                <div class="flex-grow-1">
                                    <input type="text" name="image_featured2" class="form-control form-control-sm border-0 bg-light" value="{{$project->image_featured2}}" placeholder="https://...">
                                    <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">Copie a URL do Media Center para maior performance</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categoria e Descrição Curta -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Categoria do Portfólio</label>
                        <select name="project_category_id" id="project_category_id" class="form-select form-select-lg bg-light border-0 shadow-none">
                            @foreach($categories as $category)
                                <option @if($project->project_category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Resumo Curto (Excerpt)</label>
                        <textarea name="excerpt" class="form-control form-control-lg bg-light border-0 shadow-none" rows="1">{{$project->excerpt}}</textarea>
                    </div>

                    <!-- Conteúdo Rico -->
                    <div class="col-12 mt-4">
                        <label class="form-label fw-bold small text-muted uppercase mb-3">Conteúdo Detalhado do Projeto</label>
                        <div class="rounded-4 overflow-hidden border shadow-sm">
                            <textarea name="body" class="form-control summernote" id="body" rows="20">{{$project->body}}</textarea>
                        </div>
                    </div>

                    <!-- Galeria de Imagens -->
                    <div class="col-12 mt-5">
                        <h6 class="fw-bold text-dark mb-4 border-start border-4 border-primary ps-3 uppercase">Galeria do Projeto <small class="text-muted fw-normal">(URLs Externas)</small></h6>
                        <div class="row g-3">
                            @for ($i = 1; $i <= 4; $i++)
                            @php $galField = "img_gal$i"; @endphp
                            <div class="col-md-3">
                                <div class="card bg-white border shadow-sm p-2 rounded-4 h-100">
                                    <div class="position-relative mb-2">
                                        <img loading="lazy" class="img-fluid rounded-3 shadow-sm d-block mx-auto" style="height: 120px; width: 100%; object-fit: cover;" src="{{$project->$galField ? $project->$galField : asset('img/200x200.png')}}">
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-primary rounded-circle p-2" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">{{$i}}</span>
                                        </div>
                                    </div>
                                    <input type="text" name="{{$galField}}" class="form-control form-control-sm border-0 bg-light" value="{{$project->$galField}}" placeholder="Cole o link da imagem">
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Informações do Cliente -->
                    <div class="col-md-12 mt-5">
                        <h6 class="fw-bold text-dark mb-4 border-start border-4 border-primary ps-3 uppercase">Informações Corporativas & Links</h6>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted uppercase">Data de Conclusão</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-calendar-alt text-primary opacity-50"></i></span>
                            <input type="text" name="date" class="form-control form-control-lg bg-light border-0 shadow-none" value="{{$project->date}}" placeholder="Ex: Março 2024">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted uppercase">Nome do Cliente</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-user-tie text-primary opacity-50"></i></span>
                            <input type="text" name="client" class="form-control form-control-lg bg-light border-0 shadow-none" value="{{$project->client}}" placeholder="Nome do Cliente">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted uppercase">Botão de Ação Externo</label>
                        <div class="input-group shadow-sm rounded-3 overflow-hidden border">
                            <input type="text" name="button_text" class="form-control border-0 bg-white" value="{{$project->button_text}}" placeholder="Texto (Ver Site)">
                            <div class="vr"></div>
                            <input type="text" name="button_link" class="form-control border-0 bg-white" value="{{$project->button_link}}" placeholder="Link (http://)">
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="col-12 mt-5">
                        <div class="card text-bg-dark border-0 rounded-4 shadow-lg overflow-hidden">
                            <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                                <h6 class="m-0 fw-bold"><i class="fas fa-search me-2"></i> Configurações de SEO para Projetos</h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Título (SEO)</label>
                                        <input type="text" name="meta_title" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$project->meta_title}}" placeholder="Título otimizado para o Google">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Descrição (SEO)</label>
                                        <textarea name="meta_description" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" rows="2" placeholder="Pequena descrição atraente para os resultados de busca">{{$project->meta_description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow rounded-pill fw-bold">
                            <i class="fas fa-save me-2"></i> ATUALIZAR PROJETO GOURMET
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

