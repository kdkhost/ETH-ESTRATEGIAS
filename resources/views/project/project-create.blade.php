@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.create_project') )}}</h1>
        <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> {{clean( trans('niva-backend.back_projectpage') )}}
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.create_project') )}}</h6>
                </div>
                <div class="col-auto">
                    @if (!empty($langs))
                        <select name="language" class="form-select form-select-sm language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">

            @include('includes.form-errors')

            <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="language_id" value="{{$lang_id}}">

                <div class="row g-4">
                    <!-- Basic Info -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                            <input type="text" name="title" class="form-control" placeholder="Nome do projeto">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}}</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light text-muted">{{URL::to('/')}}/{{clean( trans('niva-backend.project') )}}/</span>
                                <input type="text" name="slug" class="form-control" placeholder="url-do-projeto">
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.photo') )}} Principal</label>
                            <input type="file" name="photo_id" class="form-control" id="photo_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Imagem de Destaque (URL)</label>
                            <input type="text" name="image_featured2" class="form-control" placeholder="https://...">
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.categories') )}}</label>
                            <select name="project_category_id" id="project_category_id" class="form-select">
                                <option selected disabled>{{clean( trans('niva-backend.choose_category') )}}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Resumo (Body)</label>
                            <textarea name="body" class="form-control" id="body" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Descrição Completa</label>
                            <textarea name="excerpt" class="form-control summernote" id="excerpt" rows="15"></textarea>
                        </div>
                    </div>

                    <!-- Gallery URLs -->
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Imagem Galeria 1</label>
                            <input type="text" name="img_gal1" class="form-control bg-light border-0" placeholder="URL da imagem">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Imagem Galeria 2</label>
                            <input type="text" name="img_gal2" class="form-control bg-light border-0" placeholder="URL da imagem">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Imagem Galeria 3</label>
                            <input type="text" name="img_gal3" class="form-control bg-light border-0" placeholder="URL da imagem">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Imagem Galeria 4</label>
                            <input type="text" name="img_gal4" class="form-control bg-light border-0" placeholder="URL da imagem">
                        </div>
                    </div>

                    <!-- Project Meta -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.duration_project') )}}</label>
                            <input type="text" name="date" class="form-control" placeholder="Ex: Jan 2024 - Mar 2024">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.client') )}}</label>
                            <input type="text" name="client" class="form-control" placeholder="Nome do cliente">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}}</label>
                            <input type="text" name="button_text" class="form-control" placeholder="Ver projeto">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}}</label>
                            <input type="text" name="button_link" class="form-control" placeholder="https://...">
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_title') )}}</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Meta título SEO">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_description') )}}</label>
                            <input type="text" name="meta_description" class="form-control" placeholder="Meta descrição SEO">
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5">
                            <i class="fas fa-save me-1"></i> {{clean( trans('niva-backend.create') )}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
