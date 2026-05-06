@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.headerfooter_settings') )}}</h1>
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

    <form action="{{route('headerfooter-setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Sidebar / Topbar Buttons -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-external-link-square-alt me-2"></i> {{clean( trans('niva-backend.start_project_button') )}} 1</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                            <input type="text" name="sidebar_title" class="form-control" value="{{$setting->sidebar_title}}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}}</label>
                            <input type="text" name="sidebar_description" class="form-control" value="{{$setting->sidebar_description}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-external-link-square-alt me-2"></i> {{clean( trans('niva-backend.start_project_button') )}} 2</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}} 2</label>
                            <input type="text" name="sidebar_title2" class="form-control" value="{{$setting->sidebar_title2}}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.link') )}} 2</label>
                            <input type="text" name="sidebar_description2" class="form-control" value="{{$setting->sidebar_description2}}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Typed Text -->
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-keyboard me-2"></i> {{clean( trans('niva-backend.footer_typed_text_section') )}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.typed_title') )}}</label>
                                <input type="text" name="typed_title" class="form-control" value="{{$setting->typed_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.typed_text') )}}</label>
                                <input type="text" name="typed_text" class="form-control" value="{{$setting->typed_text}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}}</label>
                                <input type="text" name="typed_buttontext" class="form-control" value="{{$setting->typed_buttontext}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}}</label>
                                <input type="text" name="typed_buttonlink" class="form-control" value="{{$setting->typed_buttonlink}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Columns -->
            <div class="col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-columns me-2"></i> {{clean( trans('niva-backend.footer_col_1') )}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.subtitle') )}}</label>
                                <input type="text" name="footer_col1_subtitle" class="form-control" value="{{$setting->footer_col1_subtitle}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                                <input type="text" name="footer_col1_title" class="form-control" value="{{$setting->footer_col1_title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}}</label>
                                <input type="text" name="footer_col1_buttontext" class="form-control" value="{{$setting->footer_col1_buttontext}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}}</label>
                                <input type="text" name="footer_col1_buttonlink" class="form-control" value="{{$setting->footer_col1_buttonlink}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-columns me-2"></i> {{clean( trans('niva-backend.footer_col_2') )}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título 1</label>
                                <input type="text" name="footer_col2_title1" class="form-control" value="{{$setting->footer_col2_title1}}">
                                <textarea name="footer_col2_html1" class="form-control mt-2 text-monospace" rows="4">{{$setting->footer_col2_html1}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Título 2</label>
                                <input type="text" name="footer_col2_title2" class="form-control" value="{{$setting->footer_col2_title2}}">
                                <textarea name="footer_col2_html2" class="form-control mt-2 text-monospace" rows="4">{{$setting->footer_col2_html2}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Sections -->
            <div class="col-md-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-share-alt me-2"></i> {{clean( trans('niva-backend.social_links') )}}</h6>
                    </div>
                    <div class="card-body">
                        <textarea name="social_links" class="form-control text-monospace" rows="6">{{$setting->social_links}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left me-2"></i> Descrição Sidebar</h6>
                    </div>
                    <div class="card-body">
                        <textarea name="sidebar_menu_description" class="form-control text-monospace" rows="6">{{$setting->sidebar_menu_description}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-copyright me-2"></i> Copyright</h6>
                    </div>
                    <div class="card-body">
                        <textarea name="footer_copyright" class="form-control text-monospace" rows="6">{{$setting->footer_copyright}}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg shadow px-5 py-3 rounded-pill">
                    <i class="fas fa-save me-2"></i> Salvar Todas as Alterações
                </button>
            </div>
        </div>
    </form>
</div>

@stop

@section('styles')
<style>
    .text-monospace { font-family: 'Courier New', Courier, monospace; font-size: 13px; }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
</style>
@stop