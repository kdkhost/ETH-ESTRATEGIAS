@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.create_article') )}}</h1>
        <a href="{{route('post.index') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> {{clean( trans('niva-backend.back_blogpage') )}}
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.create_article') )}}</h6>
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

            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="language_id" value="{{$lang_id}}">

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                            <input type="text" name="title" class="form-control" placeholder="Título do post">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}}</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light text-muted">{{URL::to('/')}}/{{clean( trans('niva-backend.post') )}}/</span>
                                <input type="text" name="slug" class="form-control" placeholder="slug-da-url">
                            </div>
                        </div>
                    </div>  

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.photo') )}}</label>
                            <input type="file" name="photo_id" class="form-control" id="photo_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.categories') )}}</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option selected disabled>{{clean( trans('niva-backend.choose_category') )}}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>  

                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.body') )}}</label>
                            <textarea name="body" class="form-control summernote" id="body" rows="15"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_title') )}}</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Título para SEO">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_description') )}}</label>
                            <input type="text" name="meta_description" class="form-control" placeholder="Descrição para SEO">
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5">
                            <i class="fas fa-save me-1"></i> {{clean( trans('niva-backend.create_article') )}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
