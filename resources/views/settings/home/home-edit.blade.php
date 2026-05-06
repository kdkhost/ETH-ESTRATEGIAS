@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.home_settings') )}}</h1>
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

    <div class="row g-4">
        
        <!-- SECTION 1: Slider Management -->
        <div class="col-12">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-sliders-h me-2"></i> {{clean( trans('niva-backend.section_1_main_slider') )}}</h6>
                    <div class="d-flex gap-2">
                        <a class="btn btn-sm btn-primary" href="{{ route('slider.index') . '?language=' . request()->input('language')}}">Ver Todos</a>
                        <a class="btn btn-sm btn-light border" href="{{ route('slider.create') . '?language=' . request()->input('language')}}">Novo Slider</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: About Section -->
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-card me-2"></i> {{clean( trans('niva-backend.section_3_about') )}}</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título</label>
                                <input type="text" name="about_title" class="form-control" value="{{$setting->about_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Subtítulo</label>
                                <input type="text" name="about_subtitle" class="form-control" value="{{$setting->about_subtitle}}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Descrição</label>
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
                        </div>

                        <!-- Tooltips / Floating Images -->
                        <div class="row g-4 mt-4">
                            @for ($i = 1; $i <= 3; $i++)
                            @php $imgField = "about_image$i"; $tit1Field = "about_image{$i}_titlu1"; $tit2Field = "about_image{$i}_titlu2"; @endphp
                            <div class="col-md-4">
                                <div class="bg-light p-3 rounded-4 border">
                                    <label class="form-label small fw-bold">Imagem Flutuante {{$i}}</label>
                                    @if($setting->$imgField)
                                    <img src="{{$setting->$imgField}}" class="img-fluid rounded mb-2 shadow-sm d-block mx-auto" style="max-height: 60px;">
                                    @endif
                                    <input type="text" name="{{$imgField}}" class="form-control form-control-sm mb-2" value="{{$setting->$imgField}}" placeholder="URL da Imagem">
                                    <input type="text" name="{{$tit1Field}}" class="form-control form-control-sm mb-1" value="{{$setting->$tit1Field}}" placeholder="Texto 1">
                                    <input type="text" name="{{$tit2Field}}" class="form-control form-control-sm" value="{{$setting->$tit2Field}}" placeholder="Texto 2">
                                </div>
                            </div>
                            @endfor
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Anos de Experiência (Número)</label>
                                <input type="text" name="about_yearstitle" class="form-control" value="{{$setting->about_yearstitle}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Texto de Experiência</label>
                                <input type="text" name="about_yearstext" class="form-control" value="{{$setting->about_yearstext}}">
                            </div>
                        </div>

                        <div class="text-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary shadow-sm px-5">Atualizar Seção Sobre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Fun Facts -->
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-grin-stars me-2"></i> {{clean( trans('niva-backend.section_2_fun_facts') )}}</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título Principal</label>
                                <input type="text" name="fun_title" class="form-control" value="{{$setting->fun_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Descrição Curta</label>
                                <input type="text" name="fun_description" class="form-control" value="{{$setting->fun_description}}">
                            </div>
                        </div>

                        <div class="row g-3">
                            @for ($i = 1; $i <= 4; $i++)
                            @php $iconField = "count_icon$i"; $numField = "count_number$i"; $descField = "count_description$i"; @endphp
                            <div class="col-md-3">
                                <div class="p-3 border rounded-4 text-center bg-light h-100">
                                    <div class="mb-2"><i class="{{$setting->$iconField}} fa-2x text-primary opacity-50"></i></div>
                                    <label class="form-label small fw-bold">Ícone {{$i}}</label>
                                    <input type="text" name="{{$iconField}}" class="form-control form-control-sm mb-2" value="{{$setting->$iconField}}">
                                    <label class="form-label small fw-bold">Número</label>
                                    <input type="text" name="{{$numField}}" class="form-control form-control-sm mb-2" value="{{$setting->$numField}}">
                                    <label class="form-label small fw-bold">Texto</label>
                                    <input type="text" name="{{$descField}}" class="form-control form-control-sm" value="{{$setting->$descField}}">
                                </div>
                            </div>
                            @endfor
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary shadow-sm px-5">Atualizar Estatísticas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECTION 4: Services -->
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-concierge-bell me-2"></i> {{clean( trans('niva-backend.section_4_services') )}}</h6>
                    <a class="btn btn-sm btn-outline-primary border-0" href="{{ route('service.index') . '?language=' . request()->input('language')}}"><i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Título da Seção</label>
                            <input type="text" name="services_title" class="form-control" value="{{$setting->services_title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Descrição</label>
                            <textarea name="sevices_text" class="form-control" rows="4">{{$setting->sevices_text}}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm px-4">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECTION 5: Portfolio -->
        <div class="col-md-6">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-briefcase me-2"></i> {{clean( trans('niva-backend.section_5_portfolio') )}}</h6>
                    <a class="btn btn-sm btn-outline-primary border-0" href="{{ route('project.index') . '?language=' . request()->input('language')}}"><i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Título da Seção</label>
                            <input type="text" name="projects_title" class="form-control" value="{{$setting->projects_title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subtítulo</label>
                            <input type="text" name="projects_subtitle" class="form-control" value="{{$setting->projects_subtitle}}">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-sm px-4">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECTION 6: Testimonials & Blog Titles -->
        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-quote-left me-2"></i> Depoimentos</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Título</label>
                                <input type="text" name="testimonial_title" class="form-control form-control-sm" value="{{$setting->testimonial_title}}">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Subtítulo</label>
                                <input type="text" name="testimonial_subtitle" class="form-control form-control-sm" value="{{$setting->testimonial_subtitle}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-3 w-100">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-newspaper me-2"></i> Seção Blog</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label small fw-bold">Título</label>
                                <input type="text" name="blog_title" class="form-control form-control-sm" value="{{$setting->blog_title}}">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold">Subtítulo</label>
                                <input type="text" name="blog_subtitle" class="form-control form-control-sm" value="{{$setting->blog_subtitle}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-3 w-100">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="col-12 mt-4">
            <div class="card shadow border-0 text-bg-primary">
                <div class="card-header py-3 border-0 bg-transparent">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO Principal da Home</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('home-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Meta Título</label>
                                <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0" value="{{$setting->meta_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white">Meta Descrição</label>
                                <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0" value="{{$setting->meta_description}}">
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-light shadow-sm px-5 fw-bold">Salvar SEO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('styles')
<style>
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    .card { transition: transform 0.2s; }
    .card:hover { transform: translateY(-2px); }
</style>
@stop