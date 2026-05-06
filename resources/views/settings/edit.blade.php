@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.title_log_favicon') )}}</h1>
        @if (!empty($langs))
            <select name="language" class="form-select form-select-sm language-control ms-auto shadow-sm" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                @foreach ($langs as $lang)
                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    @if ($message = Session::get('setting_success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('includes.form-errors')

    <form action="{{route('setting.update', $lang_id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            <!-- Branding Section -->
            <div class="col-12">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fingerprint me-2"></i> Identidade Visual</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6">
                                <label class="form-label fw-bold small text-muted uppercase">Nome do Website</label>
                                <input type="text" name="title" value="{{$setting->title}}" class="form-control form-control-lg shadow-sm" placeholder="Ex: ETH Estratégias">
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label fw-bold d-block small text-muted uppercase text-center mb-3">Logo Principal</label>
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <div class="bg-light p-3 rounded-4 border shadow-sm d-inline-block">
                                        <img loading="lazy" height="50" src="{{$setting->photo ? asset('images/media/' . $setting->photo->file) : asset('img/200x200.png')}}" alt="Logo Current">
                                    </div>
                                    <input type="file" name="photo_id" class="filepond">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label fw-bold d-block small text-muted uppercase text-center mb-3">Favicon</label>
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <div class="bg-light p-3 rounded-4 border shadow-sm d-inline-block">
                                        @if ($setting->favicon) <img loading="lazy" height="32" src="{{$setting->favicon}}" /> @else <i class="fas fa-icons fa-2x text-muted opacity-25"></i> @endif
                                    </div>
                                    <input type="text" name="favicon" value="{{$setting->favicon}}" class="form-control form-control-sm" placeholder="URL do Favicon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maintenance & Loader -->
            <div class="col-md-7">
                <div class="card shadow border-0 h-100 rounded-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tools me-2"></i> Modo Manutenção e Carregamento</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold d-block small text-muted uppercase mb-3">Status de Manutenção</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="maintenance_status" id="m1" value="1" {{$setting->maintenance_status == 1 ? 'checked' : ''}}>
                                    <label class="btn btn-outline-danger py-2" for="m1"><i class="fas fa-lock me-2"></i> Ativado</label>
                                    <input type="radio" class="btn-check" name="maintenance_status" id="m0" value="0" {{$setting->maintenance_status == 0 ? 'checked' : ''}}>
                                    <label class="btn btn-outline-success py-2" for="m0"><i class="fas fa-unlock me-2"></i> Desativado</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold d-block small text-muted uppercase mb-3">Status do Carregador (Loader)</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="loader_status" id="l1" value="1" {{$setting->loader_status == 1 ? 'checked' : ''}}>
                                    <label class="btn btn-outline-primary py-2" for="l1">Com Loader</label>
                                    <input type="radio" class="btn-check" name="loader_status" id="l0" value="0" {{$setting->loader_status == 0 ? 'checked' : ''}}>
                                    <label class="btn btn-outline-secondary py-2" for="l0">Sem Loader</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted uppercase">Mensagem de Manutenção (Exibida aos usuários)</label>
                                <textarea name="maintenance_text" class="form-control summernote" rows="5">{{$setting->maintenance_text}}</textarea>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-muted uppercase">URL do Loader Personalizado</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-spinner text-primary"></i></span>
                                    <input type="text" name="loader_img" value="{{$setting->loader_img}}" class="form-control" placeholder="https://...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Cor de Fundo do Loader</label>
                                <input type="color" name="loader_color" value="{{$setting->loader_color}}" class="form-control form-control-color w-100 border-0 bg-transparent p-0" style="height: 38px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO & Analytics -->
            <div class="col-md-5">
                <div class="card shadow border-0 h-100 text-bg-dark rounded-4 overflow-hidden">
                    <div class="card-header py-3 border-0 bg-transparent">
                        <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO e Rastreamento Global</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white opacity-75 small uppercase">Palavras-chave (Keywords)</label>
                            <textarea name="keywords" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" rows="3" placeholder="tag1, tag2, tag3...">{{$setting->keywords}}</textarea>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-white opacity-75 uppercase">Google Analytics</label>
                                <select name="analytics_switch" class="form-select bg-white bg-opacity-10 text-white border-0 small">
                                    <option value="1" {{$setting->analytics_switch == 1 ? 'selected' : ''}} class="text-dark">Ativado</option>
                                    <option value="0" {{$setting->analytics_switch == 0 ? 'selected' : ''}} class="text-dark">Desativado</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-white opacity-75 uppercase">Facebook Pixel</label>
                                <select name="facebook_pixel_switch" class="form-select bg-white bg-opacity-10 text-white border-0 small">
                                    <option value="1" {{$setting->facebook_pixel_switch == 1 ? 'selected' : ''}} class="text-dark">Ativado</option>
                                    <option value="0" {{$setting->facebook_pixel_switch == 0 ? 'selected' : ''}} class="text-dark">Desativado</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-white opacity-75 uppercase">ID do Google Analytics</label>
                            <input type="text" name="analytics" value="{{$setting->analytics}}" class="form-control bg-white bg-opacity-10 text-white border-0" placeholder="UA-XXXXXXXXX-X">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold text-white opacity-75 uppercase">ID do Facebook Pixel</label>
                            <input type="text" name="facebook_pixel" value="{{$setting->facebook_pixel}}" class="form-control bg-white bg-opacity-10 text-white border-0" placeholder="Pixel ID">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Global Info -->
            <div class="col-12">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Informações Corporativas Globais</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Autor / Copyright</label>
                                <input type="text" name="author" value="{{$setting->author}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Endereço da Sede</label>
                                <input type="text" name="address" value="{{$setting->address}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Telefone / WhatsApp Geral</label>
                                <input type="text" name="phone" value="{{$setting->phone}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Code Section -->
            <div class="col-12">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-code me-2"></i> Injeção de Código Customizado</h6>
                        <span class="badge bg-warning-subtle text-warning ms-auto small">Uso Avançado</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-md-6 border-end">
                                <div class="bg-light p-2 border-bottom small fw-bold text-uppercase opacity-50 ps-3">Custom CSS (Estilos)</div>
                                <textarea data-editor="css" name="custom_css" class="form-control border-0 rounded-0" rows="15">{{$setting->custom_css}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-2 border-bottom small fw-bold text-uppercase opacity-50 ps-3">Custom JS (Scripts)</div>
                                <textarea data-editor="javascript" name="custom_js" class="form-control border-0 rounded-0" rows="15">{{$setting->custom_js}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center my-5">
                <button type="submit" class="btn btn-primary btn-lg shadow px-5 py-3 rounded-pill fw-bold">
                    <i class="fas fa-save me-2"></i> SALVAR CONFIGURAÇÕES PREMIUM
                </button>
            </div>
        </div>
    </form>
</div>

@stop

@section('styles')
<style>
    .rounded-4 { border-radius: 1rem !important; }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; }
    .form-control, .form-select, .input-group-text { border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    [data-bs-theme="dark"] .bg-light { background-color: rgba(255,255,255,0.05) !important; }
    .ace-editor-container { border-radius: 0; border: none; }
</style>
@stop

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>

<script type="text/javascript">
$(function() {
  // Inicialização do FilePond para o Logo
  const inputElement = document.querySelector('input[name="photo_id"]');
  if(inputElement) {
      FilePond.create(inputElement, {
          storeAsFile: true,
          labelIdle: '<i class="fas fa-upload fa-2x opacity-25"></i><br>Logo'
      });
  }

  // Editores ACE para CSS/JS
  $('textarea[data-editor]').each(function() {
    var textarea = $(this);
    var mode = textarea.data('editor');
    var editDiv = $('<div>', {
      position: 'relative',
      width: '100%',
      height: '400px',
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
        enableBasicAutocompletion: true,
        useWorker: false
    });

    textarea.closest('form').submit(function() {
      textarea.val(editor.getSession().getValue());
    })
  });
});
</script>
@stop
