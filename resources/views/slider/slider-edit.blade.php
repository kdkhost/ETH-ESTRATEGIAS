@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_slider') )}}</h1>
        <a href="{{route('slider.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_slider') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-magic me-2"></i> Customização do Slider Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Textos Principais -->
                    <div class="col-lg-8">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Título Principal (H1)</label>
                                <input type="text" name="heading1" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$slider->heading1}}" placeholder="Ex: Inovação Digital">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Subtítulo Estratégico</label>
                                <input type="text" name="heading2" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$slider->heading2}}" placeholder="Ex: Para sua Empresa">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted uppercase">Texto Dinâmico (Typed Effect)</label>
                            <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                                <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-keyboard text-primary opacity-50"></i></span>
                                <input type="text" name="typed_text" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$slider->typed_text}}" placeholder="Palavras separadas por vírgula">
                            </div>
                            <small class="text-muted mt-2 d-block ms-1" style="font-size: 0.7rem;">As palavras aparecerão com efeito de digitação. Ex: Qualidade, Performance, Design</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted uppercase mb-3">Descrição de Apoio</label>
                            <div class="rounded-4 overflow-hidden border shadow-sm">
                                <textarea name="bodyslider" class="form-control summernote" id="bodyslider" rows="10">{{$slider->bodyslider}}</textarea>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 rounded-4 p-3 shadow-none">
                                    <h6 class="fw-bold small text-muted uppercase mb-3"><i class="fas fa-mouse-pointer me-2"></i> Botão Primário</h6>
                                    <div class="mb-2">
                                        <input type="text" name="button_text" class="form-control border-0 bg-white shadow-sm mb-2" value="{{$slider->button_text}}" placeholder="Texto">
                                        <input type="text" name="button_link" class="form-control border-0 bg-white shadow-sm" value="{{$slider->button_link}}" placeholder="URL Link">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0 rounded-4 p-3 shadow-none">
                                    <h6 class="fw-bold small text-muted uppercase mb-3"><i class="fas fa-link me-2"></i> Botão Secundário</h6>
                                    <div class="mb-2">
                                        <input type="text" name="button_text2" class="form-control border-0 bg-white shadow-sm mb-2" value="{{$slider->button_text2}}" placeholder="Texto">
                                        <input type="text" name="button_link2" class="form-control border-0 bg-white shadow-sm" value="{{$slider->button_link2}}" placeholder="URL Link">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mídia e Ações -->
                    <div class="col-lg-4">
                        <div class="card gourmet-card-light border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-0">
                                <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-image me-2"></i> Imagem de Fundo</h6>
                            </div>
                            <div class="card-body p-4 text-center">
                                <div class="mb-4 position-relative">
                                    <img loading="lazy" class="img-fluid rounded-4 shadow border-4 border-white mb-3 mx-auto d-block" style="max-height: 250px; width: 100%; object-fit: cover;" src="{{$slider->photo ? asset('images/media/' . $slider->photo->file) : asset('img/200x200.png')}}">
                                    @if($slider->photo)
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-success rounded-pill shadow-sm">Ativo</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-start">
                                    <label class="form-label small fw-bold text-muted uppercase mb-3">Substituir Background</label>
                                    <input type="file" name="photo_id" class="form-control border-0 bg-light rounded-3 shadow-none" id="photo_id">
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.7rem;">Resolução recomendada: 1920x1080px (Alta Definição)</small>
                                </div>
                            </div>
                        </div>

                        <div class="card gourmet-card-light shadow-lg border-0 sticky-top" style="top: 100px;">
                            <div class="card-body p-4 d-grid gap-3">
                                <button type="submit" class="btn btn-primary btn-lg shadow-lg rounded-pill py-3 fw-bold">
                                    <i class="fas fa-save me-2"></i> ATUALIZAR SLIDER
                                </button>
                                <a href="{{route('slider.index')}}" class="btn btn-light border-0 py-2 small text-muted rounded-pill">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
