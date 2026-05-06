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
                <div class="card shadow border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                            <input type="text" name="title" class="form-control form-control-lg border-0 bg-light rounded-4" value="{{$post->title}}" placeholder="Título do post...">
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 small opacity-50">{{URL::to('/')}}/blog/</span>
                                <input type="text" name="slug" class="form-control border-0 bg-light" value="{{$post->slug}}">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.body') )}}</label>
                            <textarea name="body" class="form-control summernote" rows="20">{!! clean($post->body) !!}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card shadow border-0 text-bg-primary">
                    <div class="card-header py-3 border-0 bg-transparent">
                        <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO do Artigo</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small">Meta Título</label>
                                <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0" value="{{$post->meta_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small">Meta Descrição</label>
                                <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0" value="{{$post->meta_description}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Featured Image -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-image me-2"></i> Imagem de Destaque</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            @if($post->photo)
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 200px;" src="{{asset('images/media/' . $post->photo->file)}}">
                            @else
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 200px;" src="{{asset('img/200x200.png')}}">
                            @endif
                        </div>
                        <div class="text-start">
                            <label class="form-label small fw-bold">Alterar Imagem</label>
                            <input type="file" name="photo_id" class="filepond" id="photo_id" data-allow-reorder="true">
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tags me-2"></i> Categoria</h6>
                    </div>
                    <div class="card-body">
                        <select name="category_id" id="category_id" class="form-select border-0 bg-light">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card shadow border-0 sticky-top" style="top: 20px;">
                    <div class="card-body d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill py-3">
                            <i class="fas fa-save me-2"></i> Salvar Postagem
                        </button>
                        <a href="{{route('post.index')}}" class="btn btn-light border-0 py-2 small">Cancelar</a>
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
