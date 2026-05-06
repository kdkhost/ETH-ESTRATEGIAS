@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.headerfooter_settings') )}}</h1>
        @if (!empty($langs))
            <select name="language" class="form-select form-select-sm language-control ms-auto shadow-sm" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                @foreach ($langs as $lang)
                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    @include('includes.form-errors')

    <form action="{{route('headerfooter-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            <!-- Botões de Ação (Sidebar/Topbar) -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100 rounded-4 overflow-hidden">
                    <div class="card-header py-3 bg-primary text-white border-0">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-rocket me-2"></i> {{clean( trans('niva-backend.start_project_button') )}} 1</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Título do Botão</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-tag text-primary"></i></span>
                                <input type="text" name="sidebar_title" class="form-control border-start-0 ps-0" value="{{$setting->sidebar_title}}" placeholder="Ex: Iniciar Projeto">
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold text-muted small uppercase">Link de Destino</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-link text-primary"></i></span>
                                <input type="text" name="sidebar_description" class="form-control border-start-0 ps-0" value="{{$setting->sidebar_description}}" placeholder="Ex: /contato">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow border-0 h-100 rounded-4 overflow-hidden">
                    <div class="card-header py-3 bg-secondary text-white border-0">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-rocket me-2"></i> {{clean( trans('niva-backend.start_project_button') )}} 2</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Título do Botão 2</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-tag text-secondary"></i></span>
                                <input type="text" name="sidebar_title2" class="form-control border-start-0 ps-0" value="{{$setting->sidebar_title2}}" placeholder="Ex: Ver Portfolio">
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold text-muted small uppercase">Link de Destino 2</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-link text-secondary"></i></span>
                                <input type="text" name="sidebar_description2" class="form-control border-start-0 ps-0" value="{{$setting->sidebar_description2}}" placeholder="Ex: /portfolio">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Efeito de Digitação no Rodapé -->
            <div class="col-12">
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="card-header py-3 bg-dark text-white border-0">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-keyboard me-2"></i> {{clean( trans('niva-backend.footer_typed_text_section') )}}</h6>
                    </div>
                    <div class="card-body p-4 bg-light bg-opacity-10">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título Estático</label>
                                <input type="text" name="typed_title" class="form-control form-control-lg border-0 shadow-sm" value="{{$setting->typed_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Textos Variáveis (Separados por vírgula)</label>
                                <input type="text" name="typed_text" class="form-control form-control-lg border-0 shadow-sm" value="{{$setting->typed_text}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Texto do Botão</label>
                                <input type="text" name="typed_buttontext" class="form-control border-0 shadow-sm" value="{{$setting->typed_buttontext}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Link do Botão</label>
                                <input type="text" name="typed_buttonlink" class="form-control border-0 shadow-sm" value="{{$setting->typed_buttonlink}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colunas do Rodapé -->
            <div class="col-lg-6">
                <div class="card shadow border-0 rounded-4 overflow-hidden h-100">
                    <div class="card-header py-3 bg-white border-bottom">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-th-large me-2"></i> {{clean( trans('niva-backend.footer_col_1') )}}</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Subtítulo</label>
                                <input type="text" name="footer_col1_subtitle" class="form-control" value="{{$setting->footer_col1_subtitle}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Título</label>
                                <input type="text" name="footer_col1_title" class="form-control" value="{{$setting->footer_col1_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Texto do Botão</label>
                                <input type="text" name="footer_col1_buttontext" class="form-control" value="{{$setting->footer_col1_buttontext}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Link do Botão</label>
                                <input type="text" name="footer_col1_buttonlink" class="form-control" value="{{$setting->footer_col1_buttonlink}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow border-0 rounded-4 overflow-hidden h-100">
                    <div class="card-header py-3 bg-white border-bottom">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-code me-2"></i> {{clean( trans('niva-backend.footer_col_2') )}} (HTML Personalizado)</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Título Bloco 1</label>
                                <input type="text" name="footer_col2_title1" class="form-control mb-2" value="{{$setting->footer_col2_title1}}">
                                <textarea name="footer_col2_html1" class="form-control text-monospace bg-light" rows="4" style="font-size: 12px;">{{$setting->footer_col2_html1}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Título Bloco 2</label>
                                <input type="text" name="footer_col2_title2" class="form-control mb-2" value="{{$setting->footer_col2_title2}}">
                                <textarea name="footer_col2_html2" class="form-control text-monospace bg-light" rows="4" style="font-size: 12px;">{{$setting->footer_col2_html2}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Redes Sociais e Extras -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 border-top border-4 border-info">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-share-alt me-2"></i> {{clean( trans('niva-backend.social_links') )}}</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Insira o HTML das redes sociais abaixo.</p>
                        <textarea name="social_links" class="form-control text-monospace bg-dark text-success rounded-3 border-0" rows="8" style="font-family: 'Consolas', monospace; font-size: 13px; line-height: 1.5;">{{$setting->social_links}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 border-top border-4 border-warning">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-align-left me-2"></i> Descrição Sidebar</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Texto exibido no menu lateral (sidebar).</p>
                        <textarea name="sidebar_menu_description" class="form-control text-monospace bg-light rounded-3" rows="8" style="font-size: 13px;">{{$setting->sidebar_menu_description}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100 border-top border-4 border-danger">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-copyright me-2"></i> Copyright</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Informações de direitos autorais no rodapé.</p>
                        <textarea name="footer_copyright" class="form-control text-monospace bg-light rounded-3" rows="8" style="font-size: 13px;">{{$setting->footer_copyright}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center my-5">
                <button type="submit" class="btn btn-primary btn-lg shadow-lg px-5 py-3 rounded-pill fw-bold">
                    <i class="fas fa-save me-2"></i> ATUALIZAR CONFIGURAÇÕES PREMIUM
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
    .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15); border-color: #0d6efd; }
    .input-group-text { border-color: #dee2e6; }
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.05); }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    [data-bs-theme="dark"] .bg-light { background-color: rgba(255,255,255,0.05) !important; }
</style>
@stop