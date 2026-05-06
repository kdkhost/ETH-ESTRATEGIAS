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
                                        <!-- Módulo SEO Premium -->
                    <div class="col-12 mt-4">
                        <div class="card shadow border-0 text-bg-indigo" style="background-color: #6610f2 !important;">
                            <div class="card-header py-3 border-0 bg-transparent">
                                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO Avançado (Google)</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small">Meta Título (Máx 60 caracteres)</label>
                                        <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Título chamativo para o Google" value="{{ isset($page) ? $page->meta_title : (isset($post) ? $post->meta_title : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small">Meta Descrição (Máx 160 caracteres)</label>
                                        <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Resumo magnético para aumentar cliques" value="{{ isset($page) ? $page->meta_description : (isset($post) ? $post->meta_description : '') }}">
                                    </div>
                                </div>
                                <div class="mt-3 text-white-50 small">
                                    <i class="fas fa-info-circle me-1"></i> Preencha estes campos para que o link fique com miniatura e resumo profissional ao ser compartilhado no WhatsApp ou Facebook.
                                </div>
                            </div>
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

