@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.contact_settings') )}}</h1>
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

    <div class="row g-4">
        
        <!-- SEÇÃO 1: Banner e Ícones de Informação -->
        <div class="col-12">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book me-2"></i> {{clean( trans('niva-backend.contact_info') )}}</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('contact-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row g-4">
                            <div class="col-lg-4 text-center">
                                <label class="form-label fw-bold d-block mb-3 uppercase small">Banner Hero</label>
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 200px; object-fit: cover;" src="{{$setting->banner_img ? $setting->banner_img : asset('img/200x200.png')}}">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="banner_img" class="form-control" value="{{$setting->banner_img}}" placeholder="URL da Imagem">
                                    <a target="_blank" href="{{route('media.index')}}" class="btn btn-outline-primary">Mídia</a>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Título do Banner</label>
                                        <input type="text" name="banner_title" class="form-control" value="{{$setting->banner_title}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small">Descrição do Banner</label>
                                        <input type="text" name="banner_desc" class="form-control" value="{{$setting->banner_desc}}">
                                    </div>
                                </div>
                                <hr class="my-4 opacity-10">
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 3; $i++)
                                    @php $iconField = "box_icon$i"; $titField = "box_title$i"; $htmlField = "box_html$i"; @endphp
                                    <div class="col-md-4">
                                        <div class="p-3 bg-light rounded-4 border">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="{{$setting->$iconField}} text-primary me-2"></i>
                                                <input type="text" name="{{$iconField}}" class="form-control form-control-sm border-0 bg-transparent fw-bold" value="{{$setting->$iconField}}" placeholder="Ícone {{$i}}">
                                            </div>
                                            <input type="text" name="{{$titField}}" class="form-control form-control-sm mb-2" value="{{$setting->$titField}}" placeholder="Título {{$i}}">
                                            <textarea name="{{$htmlField}}" class="form-control form-control-sm" rows="3" placeholder="Descrição {{$i}}">{{$setting->$htmlField}}</textarea>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary px-5 shadow rounded-pill fw-bold">ATUALIZAR INFORMAÇÕES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEÇÃO 2: Configuração do Formulário de Contato -->
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4 overflow-hidden h-100">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-envelope-open-text me-2"></i> {{clean( trans('niva-backend.form_info') )}}</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('contact-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">Título do Formulário</label>
                                <input type="text" name="form_title" class="form-control form-control-lg" value="{{$setting->form_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Label: Nome</label>
                                <input type="text" name="form_input_name" class="form-control" value="{{$setting->form_input_name}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Label: E-mail</label>
                                <input type="text" name="form_input_email" class="form-control" value="{{$setting->form_input_email}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Label: Orçamento/Assunto</label>
                                <input type="text" name="form_input_budget" class="form-control" value="{{$setting->form_input_budget}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Label: Telefone</label>
                                <input type="text" name="form_input_phone" class="form-control" value="{{$setting->form_input_phone}}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-muted">Label: Mensagem</label>
                                <input type="text" name="form_message" class="form-control" value="{{$setting->form_message}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Texto do Botão Enviar</label>
                                <input type="text" name="button_text" class="form-control" value="{{$setting->button_text}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">E-mail de Destino (Admin)</label>
                                <input type="email" name="mailto" class="form-control fw-bold text-primary" value="{{$setting->mailto}}">
                            </div>
                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary shadow-sm px-4 rounded-pill">SALVAR FORMULÁRIO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEÇÃO 3: Mapa e Clientes -->
        <div class="col-lg-4">
            <div class="card shadow border-0 rounded-4 overflow-hidden mb-4">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-map-marked-alt me-2"></i> {{clean( trans('niva-backend.map_info') )}}</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('contact-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Título do Mapa</label>
                            <input type="text" name="title" class="form-control mb-3" value="{{$setting->title}}">
                            <label class="form-label fw-bold small text-muted">Iframe do Google Maps</label>
                            <textarea name="iframe_txt" class="form-control text-monospace bg-light" rows="8" style="font-size: 11px;">{{$setting->iframe_txt}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm">ATUALIZAR MAPA</button>
                    </form>
                </div>
            </div>

            <div class="card shadow border-0 rounded-4 overflow-hidden bg-light border-dashed p-3 text-center">
                <h6 class="fw-bold text-muted mb-3">Logos de Clientes</h6>
                <div class="d-grid gap-2">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('client.index') . '?language=' . request()->input('language')}}">Ver Todos</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('client.create') . '?language=' . request()->input('language')}}">Novo Cliente</a>
                </div>
            </div>
        </div>

        <!-- SEÇÃO 4: SEO -->
        <div class="col-12 mt-2">
            <div class="card text-bg-dark border-0 rounded-4 shadow-sm overflow-hidden">
                <div class="card-header bg-transparent border-bottom border-white border-opacity-10 py-3">
                    <h6 class="m-0 fw-bold"><i class="fas fa-search me-2"></i> Configurações de SEO</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{route('contact-setting.update', $setting->id)}}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Título</label>
                                <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->meta_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Descrição</label>
                                <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->meta_description}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Slug (URL)</label>
                                <input type="text" name="slug" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->slug}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-white opacity-75 small uppercase">Breadcrumb Text</label>
                                <input type="text" name="breadcrumbs_anchor" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$setting->breadcrumbs_anchor}}">
                            </div>
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-light px-5 shadow rounded-pill fw-bold">ATUALIZAR SEO</button>
                            </div>
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
    .rounded-4 { border-radius: 1rem !important; }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; }
    .form-control, .form-select, .input-group-text { border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    .border-dashed { border: 2px dashed #dee2e6 !important; }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    [data-bs-theme="dark"] .bg-light { background-color: rgba(255,255,255,0.05) !important; }
</style>
@stop