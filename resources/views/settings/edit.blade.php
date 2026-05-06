@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.title_log_favicon') )}}</h1>
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

    <form action="{{route('setting.update', $lang_id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            <!-- Branding Section -->
            <div class="col-lg-12">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-branding me-2"></i> Identidade Visual</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.website_title') )}}</label>
                                <input type="text" name="title" value="{{$setting->title}}" class="form-control">
                            </div>
                            <div class="col-md-3 text-center">
                                <label class="form-label fw-bold d-block">{{clean( trans('niva-backend.logo') )}}</label>
                                <div class="bg-light p-2 rounded mb-2 border d-inline-block">
                                    <img height="40" src="/public/images/media/{{$setting->photo ? $setting->photo->file : '200x200.png'}}" alt="Logo">
                                </div>
                                <input type="file" name="photo_id" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3 text-center">
                                <label class="form-label fw-bold d-block">Favicon</label>
                                <div class="bg-light p-2 rounded mb-2 border d-inline-block">
                                    @if ($setting->favicon) <img height="32" src="{{$setting->favicon}}" /> @endif
                                </div>
                                <input type="text" name="favicon" value="{{$setting->favicon}}" class="form-control form-control-sm" placeholder="URL do Favicon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maintenance & Loader -->
            <div class="col-md-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tools me-2"></i> Manutenção e Loader</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">{{clean( trans('niva-backend.maintenance_status') )}}</label>
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="radio" name="maintenance_status" id="m1" value="1" {{$setting->maintenance_status == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="m1">Ativado</label>
                            </div>
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="radio" name="maintenance_status" id="m0" value="0" {{$setting->maintenance_status == 0 ? 'checked' : ''}}>
                                <label class="form-check-label" for="m0">Desativado</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Texto de Manutenção</label>
                            <textarea name="maintenance_text" class="form-control" rows="3">{{$setting->maintenance_text}}</textarea>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold d-block">{{clean( trans('niva-backend.loader_status') )}}</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="loader_status" id="l1" value="1" {{$setting->loader_status == 1 ? 'checked' : ''}}>
                                <label class="btn btn-outline-primary" for="l1">Com Loader</label>
                                <input type="radio" class="btn-check" name="loader_status" id="l0" value="0" {{$setting->loader_status == 0 ? 'checked' : ''}}>
                                <label class="btn btn-outline-primary" for="l0">Sem Loader</label>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-8">
                                <label class="form-label small fw-bold">URL Imagem Loader</label>
                                <input type="text" name="loader_img" value="{{$setting->loader_img}}" class="form-control form-control-sm">
                            </div>
                            <div class="col-4">
                                <label class="form-label small fw-bold">Cor Fundo</label>
                                <input type="color" name="loader_color" value="{{$setting->loader_color}}" class="form-control form-control-sm form-control-color w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO & Analytics -->
            <div class="col-md-6">
                <div class="card shadow border-0 h-100 text-bg-dark">
                    <div class="card-header py-3 border-0 bg-transparent">
                        <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO e Rastreamento</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-white opacity-75">Palavras-chave</label>
                            <input type="text" name="keywords" value="{{$setting->keywords}}" class="form-control bg-white bg-opacity-10 text-white border-0">
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-white opacity-75">Analytics</label>
                                <select name="analytics_switch" class="form-select bg-white bg-opacity-10 text-white border-0 small">
                                    <option value="1" {{$setting->analytics_switch == 1 ? 'selected' : ''}} class="text-dark">Ativado</option>
                                    <option value="0" {{$setting->analytics_switch == 0 ? 'selected' : ''}} class="text-dark">Desativado</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-white opacity-75">Facebook Pixel</label>
                                <select name="facebook_pixel_switch" class="form-select bg-white bg-opacity-10 text-white border-0 small">
                                    <option value="1" {{$setting->facebook_pixel_switch == 1 ? 'selected' : ''}} class="text-dark">Ativado</option>
                                    <option value="0" {{$setting->facebook_pixel_switch == 0 ? 'selected' : ''}} class="text-dark">Desativado</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label small fw-bold text-white opacity-75">Código Analytics</label>
                            <input type="text" name="analytics" value="{{$setting->analytics}}" class="form-control bg-white bg-opacity-10 text-white border-0">
                        </div>
                        <div class="mt-3">
                            <label class="form-label small fw-bold text-white opacity-75">Código Pixel</label>
                            <input type="text" name="facebook_pixel" value="{{$setting->facebook_pixel}}" class="form-control bg-white bg-opacity-10 text-white border-0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Global Info -->
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Informações Globais de Contato</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Autor / Empresa</label>
                                <input type="text" name="author" value="{{$setting->author}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Endereço Principal</label>
                                <input type="text" name="address" value="{{$setting->address}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Telefone / WhatsApp</label>
                                <input type="text" name="phone" value="{{$setting->phone}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Code Section -->
            <div class="col-12">
                <div class="card shadow border-0 overflow-hidden">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-code me-2"></i> CSS e JS Customizado</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-md-6 border-end">
                                <div class="bg-light p-2 border-bottom small fw-bold text-uppercase opacity-50">Custom CSS</div>
                                <textarea data-editor="css" name="custom_css" class="form-control border-0 rounded-0" rows="12">{{$setting->custom_css}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-2 border-bottom small fw-bold text-uppercase opacity-50">Custom JS</div>
                                <textarea data-editor="javascript" name="custom_js" class="form-control border-0 rounded-0" rows="12">{{$setting->custom_js}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center my-4">
                <button type="submit" class="btn btn-primary btn-lg shadow px-5 py-3 rounded-pill">
                    <i class="fas fa-save me-2"></i> Salvar Todas as Configurações
                </button>
            </div>
        </div>
    </form>
</div>

@stop

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>

<script type="text/javascript">
$(function() {
  $('textarea[data-editor]').each(function() {
    var textarea = $(this);
    var mode = textarea.data('editor');
    var editDiv = $('<div>', {
      position: 'relative',
      width: '100%',
      height: '350px',
      'class': 'ace-editor-container'
    }).insertBefore(textarea);
    textarea.css('display', 'none');
    var editor = ace.edit(editDiv[0]);
    editor.renderer.setShowGutter(true);
    editor.getSession().setValue(textarea.val());
    editor.getSession().setMode("ace/mode/" + mode);
    editor.setTheme("ace/theme/tomorrow_night");
    editor.setOptions({
        fontSize: "14px",
        showPrintMargin: false,
        enableBasicAutocompletion: true
    });

    textarea.closest('form').submit(function() {
      textarea.val(editor.getSession().getValue());
    })
  });
});
</script>
@stop