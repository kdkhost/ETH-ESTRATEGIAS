@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_article') )}}</h1>
        <a href="{{route('post.index') . '?language=' . request()->input('language')}}" class="btn btn-light btn-sm shadow-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_blogpage') )}}
        </a>
    </div>

    @include('includes.form-errors')

    <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <div class="card gourmet-card-light shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold small text-muted uppercase">Título da Publicação Gourmet</label>
                            <input type="text" name="title" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$post->title}}" placeholder="Título do post...">
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold small text-muted uppercase">Link Permanente (Slug)</label>
                            <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                                <span class="input-group-text bg-transparent border-0 small opacity-50 ps-4 pe-2">{{URL::to('/')}}/blog/</span>
                                <input type="text" name="slug" class="form-control bg-transparent border-0 shadow-none ps-0" value="{{$post->slug}}">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label fw-bold small text-muted uppercase mb-3">Conteúdo do Artigo</label>
                            <div class="rounded-4 overflow-hidden border">
                                <textarea name="body" class="form-control summernote" rows="20">{!! clean($post->body) !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card text-bg-dark border-0 rounded-4 shadow-lg overflow-hidden">
                    <div class="card-header py-3 border-bottom border-white border-opacity-10 bg-transparent">
                        <h6 class="m-0 font-weight-bold text-white uppercase"><i class="fas fa-search me-2"></i> Otimização de SEO Premium</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Título (Google)</label>
                                <input type="text" name="meta_title" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$post->meta_title}}" placeholder="Título para o Google">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Descrição</label>
                                <input type="text" name="meta_description" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$post->meta_description}}" placeholder="Descrição atrativa">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Featured Image -->
                <div class="card gourmet-card-light shadow-sm border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-image me-2"></i> Imagem de Capa</h6>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            @if($post->photo)
                                <img loading="lazy" class="img-fluid rounded-4 shadow border-4 border-white mb-3" style="max-height: 220px; width: 100%; object-fit: cover;" src="{{asset('images/media/' . $post->photo->file)}}">
                            @else
                                <img loading="lazy" class="img-fluid rounded-4 shadow border-4 border-white mb-3" style="max-height: 220px; width: 100%; object-fit: cover;" src="{{asset('img/200x200.png')}}">
                            @endif
                        </div>
                        <div class="text-start">
                            <label class="form-label small fw-bold text-muted uppercase mb-3">Substituir Imagem</label>
                            <input type="file" name="photo_id" class="filepond" id="photo_id" data-allow-reorder="true">
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="card gourmet-card-light shadow-sm border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-tags me-2"></i> Categoria do Blog</h6>
                    </div>
                    <div class="card-body p-4">
                        <select name="category_id" id="category_id" class="form-select form-select-lg border-0 bg-light rounded-4 px-3 shadow-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card gourmet-card-light shadow-lg border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4 d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg shadow-lg rounded-pill py-3 fw-bold">
                            <i class="fas fa-check-circle me-2"></i> ATUALIZAR ARTIGO
                        </button>
                        <a href="{{route('post.index')}}" class="btn btn-light border-0 py-2 small text-muted rounded-pill">
                            <i class="fas fa-times me-1"></i> Descartar Alterações
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

@stop

@section('footer')
<script>
    $(document).ready(function() {
        // Initialize FilePond for this specific input
        const inputElement = document.querySelector('input[name="photo_id"]');
        const pond = FilePond.create(inputElement, {
            storeAsFile: true,
            labelIdle: 'Arraste a nova imagem ou <span class="filepond--label-action">Procure</span>'
        });
    });
</script>
@stop


