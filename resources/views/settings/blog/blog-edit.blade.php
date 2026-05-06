@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.blog_settings') )}}</h1>
        <div class="d-flex gap-2 ms-auto">
            <a href="{{ route('post.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-list fa-sm me-1"></i> {{clean( trans('niva-backend.view_all') )}}
            </a>
            <a href="{{ route('post.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create') )}}
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Configurações da Seção</h6>
            @if (!empty($langs))
                <select name="language" class="form-select form-select-sm language-control ms-auto" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                    <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="card-body">
            
            @include('includes.form-errors')

            <form action="{{route('blog-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light p-4 rounded-4 border-dashed mb-4">
                            <label class="form-label fw-bold d-block">{{clean( trans('niva-backend.photo') )}} do Banner</label>
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <img loading="lazy" class="img-fluid rounded shadow-sm border" style="max-height: 150px;" src="{{$setting->banner_img ? $setting->banner_img : asset('img/200x200.png')}}" alt="Banner">
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="banner_img" class="form-control" value="{{$setting->banner_img}}" placeholder="URL da imagem">
                                        <a target="_blank" href="{{route('media.index')}}" class="btn btn-outline-primary">Mídia Center</a>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Suba a imagem no Mídia Center e cole a URL aqui.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                            <input type="text" name="banner_title" class="form-control" value="{{$setting->banner_title}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.description') )}}</label>
                            <input type="text" name="banner_desc" class="form-control" value="{{$setting->banner_desc}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.html_sidebar1') )}}</label>
                            <textarea name="html_sidebar1" class="form-control text-monospace" rows="6" style="font-family: 'Courier New', Courier, monospace; font-size: 13px;">{{$setting->html_sidebar1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.html_sidebar2') )}}</label>
                            <textarea name="html_sidebar2" class="form-control text-monospace" rows="6" style="font-family: 'Courier New', Courier, monospace; font-size: 13px;">{{$setting->html_sidebar2}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5">
                            <i class="fas fa-save me-1"></i> {{clean( trans('niva-backend.update') )}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SEO Section -->
    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.seo') )}}</h6>
        </div>
        <div class="card-body">
            <form action="{{route('blog-setting.update', $setting->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_title') )}}</label>
                            <input type="text" name="meta_title" class="form-control" value="{{$setting->meta_title}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.meta_description') )}}</label>
                            <input type="text" name="meta_description" class="form-control" value="{{$setting->meta_description}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.slug') )}}</label>
                            <input type="text" name="slug" class="form-control" value="{{$setting->slug}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.anchor_text') )}}</label>
                            <input type="text" name="breadcrumbs_anchor" class="form-control" value="{{$setting->breadcrumbs_anchor}}">
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-outline-primary shadow-sm px-5">
                            <i class="fas fa-search me-1"></i> Atualizar SEO
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
    .border-dashed { border: 2px dashed #dee2e6; }
    .text-monospace { font-family: 'Courier New', Courier, monospace; }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
</style>
@stop
